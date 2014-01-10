<?php

class MainTask extends \Phalcon\CLI\Task {

    var $debug = true;

    public function mainAction() {
        $cacheFolder = APPLICATION_PATH . '/cache/data.gov.tw/' . date('Y-m-d');
        $dataFolder = APPLICATION_PATH . '/cache/data.gov.tw/' . date('Y-m-d') . '/data';
        if (!file_exists($dataFolder)) {
            mkdir($dataFolder, 0777, true);
        }
        $listUrl = 'http://data.gov.tw/?q=data_list_json';
        $listFile = $cacheFolder . '/' . $this->localFileName($listUrl);
        $jsonContent = $this->getFileContent($listFile, $listUrl);
        if (substr($jsonContent, 0, 3) === b"\xEF\xBB\xBF") {
            //skip the first 3 characters, BOM
            $jsonContent = substr($jsonContent, 3);
        }
        $nodes = json_decode($jsonContent);
        $nodesCount = count($nodes);
        $resultNodes = array();
        $counter = 0;
        foreach ($nodes AS $node) {
            ++$counter;
            if (true == $this->debug) {
                echo "Processing node {$counter} / {$nodesCount}\n";
            }
            $nodeResult = array(
                'title' => strip_tags($node->{'標題'}),
            );
            $quotePos = strpos($node->{'標題'}, '">');
            $nodeResult['link'] = 'http://data.gov.tw' . substr($node->{'標題'}, 9, $quotePos - 9);
            $fileName = $this->localFileName($nodeResult['link']);
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
                if ((substr($nodeResult['dataUrl'], 0, 1) === '/') || (false !== strpos($nodeResult['dataUrl'], 'http://data.gov.tw'))) {
                    $urlParameters = array();
                    parse_str(parse_url($nodeResult['dataUrl'], PHP_URL_QUERY), $urlParameters);
                    if (!isset($urlParameters['file'])) {
                        if (true === $this->debug) {
                            echo "something was wrong with url: {$nodeResult['dataUrl']}\n";
                        }
                        exit();
                    }
                    $nodeResult['dataUrl'] = $urlParameters['file'];
                }
                $nodeResult['dataType'] = substr($parts[$nextKey], 0, strpos($parts[$nextKey], '"'));
                $nodeResult['dataUrlHeaders'] = $this->getFileHeader("{$nodeResult['linkFile']}_{$nodeResult['dataType']}", $nodeResult['dataUrl']);
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
            if (true === $this->debug) {
                echo "getting remote file: {$remoteFile}\n";
            }
            file_put_contents($localFile, file_get_contents($remoteFile));
        }
        return file_exists($localFile) ? file_get_contents($localFile) : '';
    }

    private function getFileHeader($localFile, $remoteFile) {
        if (!file_exists($localFile)) {
            if (true === $this->debug) {
                echo "getting remote headers: {$remoteFile}\n";
            }
            file_put_contents($localFile, serialize(get_headers($remoteFile, 1)));
        }
        return file_exists($localFile) ? unserialize(file_get_contents($localFile)) : '';
    }

    private function localFileName($url) {
        $fileName = str_replace(array('/', 'http:', 'https:', '?', '&'), array('_', '', '', '_', '_'), $url);
        if (true === $this->debug) {
            echo "rename {$url} to {$fileName}\n";
        }
        return $fileName;
    }

}
