<?php

class MainTask extends \Phalcon\CLI\Task {

    public function mainAction() {
        $cacheFolder = APPLICATION_PATH . '/cache/data.gov.tw/' . date('Y-m-d');
        if (!file_exists($cacheFolder)) {
            mkdir($cacheFolder, 0777, true);
        }
        $listUrl = 'http://data.gov.tw/?q=data_list_json';
        $listFile = $cacheFolder . '/' . md5($listUrl);
        if (!file_exists($listFile)) {
            file_put_contents($listFile, file_get_contents($listUrl));
        }
        $nodes = json_decode(substr(file_get_contents($listFile), 3)); //skip the first 3 characters, BOM
        $resultNodes = array();
        foreach ($nodes AS $node) {
            $nodeResult = array(
                'title' => strip_tags($node->{'標題'}),
            );
            $quotePos = strpos($node->{'標題'}, '">');
            $nodeResult['link'] = 'http://data.gov.tw' . substr($node->{'標題'}, 9, $quotePos - 9);
            $nodeResult['linkFile'] = $cacheFolder . '/' . md5($nodeResult['link']);
            if (!file_exists($nodeResult['linkFile'])) {
                file_put_contents($nodeResult['linkFile'], file_get_contents($nodeResult['link']));
            }
            echo "{$nodeResult['link']}\n";
            $nodeContent = file_get_contents($nodeResult['linkFile']);
            $tokenCount = substr_count($nodeContent, '" class="filetype_');
            if($tokenCount === 1) {
                $parts = explode('" class="filetype_', $nodeContent);
                $nodeResult['dataUrl'] = substr($parts[0], strrpos($parts[0], '"') + 1);
                $nodeResult['dataType'] = substr($parts[1], 0, strpos($parts[1], '"'));
            }
            $nodeResult['info'] = array();
            $offset = 0;
            $pos = strpos($nodeContent, '<th class="field-label">', $offset);
            while(false !== $pos) {
                $offset = $pos + 24;
                $thEndPos = strpos($nodeContent, '</th>', $offset);
                $tdEndPos = strpos($nodeContent, '</td>', $offset);
                $nodeResult['info'][trim(strip_tags(substr($nodeContent, $offset, $thEndPos - $offset)))] = trim(strip_tags(substr($nodeContent, $thEndPos, $tdEndPos - $thEndPos)));
                // for next loop
                $pos = strpos($nodeContent, '<th class="field-label">', $offset);
            }
            $resultNodes[] = $nodeResult;
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
