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
        foreach ($nodes AS $node) {
            $nodeTitle = strip_tags($node->{'標題'});
            $quotePos = strpos($node->{'標題'}, '">');
            $link = 'http://data.gov.tw' . substr($node->{'標題'}, 9, $quotePos - 9);
            $linkFile = $cacheFolder . '/' . md5($link);
            if (!file_exists($linkFile)) {
                file_put_contents($linkFile, file_get_contents($link));
            }
            echo "{$link}\n";
            $nodeContent = file_get_contents($linkFile);
        }
    }

    /**
     * @param array $params
     */
    public function testAction(array $params) {
        echo sprintf('hello %s', $params[0]) . PHP_EOL;
        echo sprintf('best regards, %s', $params[1]) . PHP_EOL;
    }

}
