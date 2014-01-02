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
        if (!file_exists($listFile)) {
            file_put_contents($listFile, file_get_contents($listUrl));
        }
        $nodes = json_decode(substr(file_get_contents($listFile), 3)); //skip the first 3 characters, BOM
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
            if (!file_exists($nodeResult['linkFile'])) {
                file_put_contents($nodeResult['linkFile'], file_get_contents($nodeResult['link']));
            }
            $nodeContent = file_get_contents($nodeResult['linkFile']);
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
                    foreach($headers AS $key => $val) {
                        $headerText .= "{$key}:{$val}\n";
                    }
                    file_put_contents($dataFile . '_headers', $headerText);
                }

                $resultNodes[] = $nodeResult;
            }
        }
        file_put_contents(dirname(APPLICATION_PATH) . '/public/files/data.gov.tw.json', json_encode($resultNodes));
    }

    /**
     * @param array $params
     */
    public function testAction(array $params) {
        echo sprintf('hello %s', $params[0]) . PHP_EOL;
        echo sprintf('best regards, %s', $params[1]) . PHP_EOL;
    }

}
