<?php

class MainTask extends \Phalcon\CLI\Task {

    public function mainAction() {
        $cacheFolder = APPLICATION_PATH . '/cache/data.gov.tw/' . date('Y-m-d');
        if(!file_exists($cacheFolder)) {
            mkdir($cacheFolder, 0777, true);
        }
        for($i = 0; $i <= 173; $i++) {
            $targetUrl = 'http://data.gov.tw/?q=data_list&page=' . $i;
            $targetFile = $cacheFolder . '/' . md5($targetUrl);
            if(!file_exists($targetFile)) {
                file_put_contents($targetFile, file_get_contents($targetUrl));
            }
            $pageContent = file_get_contents($targetFile);
            $offset = 0;
            $pos = strpos($pageContent, '<h2  property="dc:title" datatype=""><a href="', $offset);
            while(false !== $pos) {
                $offset = $pos + 46;
                $quotePos = strpos($pageContent, '"', $offset);
                $link = 'http://data.gov.tw' . substr($pageContent, $offset, $quotePos - $offset);
                $linkFile = $cacheFolder . '/' . md5($link);
                if(!file_exists($linkFile)) {
                    file_put_contents($linkFile, file_get_contents($link));
                }
                echo "{$link}\n";
                $pos = strpos($pageContent, '<h2  property="dc:title" datatype=""><a href="', $offset);
            }
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
