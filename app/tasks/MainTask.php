<?php

class MainTask extends \Phalcon\CLI\Task {

    public function mainAction() {
        $cacheFolder = APPLICATION_PATH . '/cache/data.gov.tw/' . date('Y-m-d');
        $dataFolder = APPLICATION_PATH . '/cache/data.gov.tw/' . date('Y-m-d') . '/data';
        if (!file_exists($dataFolder)) {
            mkdir($dataFolder, 0777, true);
        }
        $listUrl = 'http://data.gov.tw/?q=data_list_json';
        $listFile = $cacheFolder . '/' . md5($listUrl);
        $jsonContent = $this->getFileContent($listFile, $listUrl);
        if (substr($jsonContent, 0, 3) === b"\xEF\xBB\xBF") {
            //skip the first 3 characters, BOM
            $jsonContent = substr($jsonContent, 3);
        }
        $nodes = json_decode($jsonContent);
        $resultNodes = array();
        $counter = 0;
        foreach ($nodes AS $node) {
            $nodeResult = array(
                'title' => strip_tags($node->{'標題'}),
            );
            $quotePos = strpos($node->{'標題'}, '">');
            $nodeResult['link'] = 'http://data.gov.tw' . substr($node->{'標題'}, 9, $quotePos - 9);
            $fileName = md5($nodeResult['link']);
            $nodeResult['linkFile'] = $cacheFolder . '/' . $fileName;
            $nodeContent = $this->getFileContent($nodeResult['linkFile'], $nodeResult['link']);
            $tokenCount = substr_count($nodeContent, '" class="filetype_');
            if ($tokenCount === 0)
                continue;
            $nodeResult['info'] = array();
            $offset = 0;
            $pos = strpos($nodeContent, '<th class="field-label">', $offset);
            while (false !== $pos) {
                $offset = $pos + 24;
                $thEndPos = strpos($nodeContent, '</th>', $offset);
                $tdEndPos = strpos($nodeContent, '</td>', $offset);
                $nodeResult['info'][trim(strip_tags(substr($nodeContent, $offset, $thEndPos - $offset)))] = trim(strip_tags(substr($nodeContent, $thEndPos, $tdEndPos - $thEndPos)));
                // for next loop
                $pos = strpos($nodeContent, '<th class="field-label">', $offset);
            }
            for ($i = 0; $i < $tokenCount; $i ++) {
                $parts = explode('" class="filetype_', $nodeContent);
                $nextKey = $i + 1;
                $nodeResult['dataUrl'] = substr($parts[$i], strrpos($parts[$i], '"') + 1);
                $nodeResult['dataType'] = substr($parts[$nextKey], 0, strpos($parts[$nextKey], '"'));

                ++$counter;
                $dataFile = $dataFolder . '/' . $fileName . '_' . $nodeResult['dataType'];
                if (!file_exists($dataFile)) {
                    ;
                    $request = new HttpRequest(urldecode('http://www.ylepb.gov.tw/df_ufiles/c/%E6%B0%B4%E5%BA%AB%E9%9B%86%E6%B0%B4%E5%8D%80.xls'), HttpRequest::METH_GET);
                    //$request = new HttpRequest(urldecode($nodeResult['dataUrl']), HttpRequest::METH_GET);
                    $request->setHeaders(array(
                        'Accept-Language' => 'en-US,en;q=0.8',
                        'Cache-Control' => 'no-cache',
                        'Connection' => 'keep-alive',
                        'Pragma' => 'no-cache',
                        'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36',
                    ));
                    try {
                        $message = $request->send();
                    } catch (HttpException $ex) {
                        //skip
                    }
                    file_put_contents($dataFile, $request->getResponseBody());
                    $headerText = "source_url:{$nodeResult['link']}\n";
                    $headerText .= "url:{$nodeResult['dataUrl']}\n";
                    $headerText .= "code:{$request->getResponseCode()}\n";
                    $headers = $message->getHeaders();
                    foreach ($headers AS $key => $val) {
                        $headerText .= "{$key}:{$val}\n";
                    }
                    file_put_contents($dataFile . '_headers', $headerText);
                }

                $resultNodes[] = $nodeResult;
            }
        }
        file_put_contents(dirname(APPLICATION_PATH) . '/public/files/data.gov.tw.json', json_encode($resultNodes));
    }

    /*
     * 
     */

    private function getFileContent($localFile, $remoteFile) {
        if (!file_exists($localFile)) {
            file_put_contents($localFile, file_get_contents($remoteFile));
        }
        return file_exists($localFile) ? file_get_contents($localFile) : '';
    }

}
