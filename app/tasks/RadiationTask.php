<?php

class RadiationTask extends \Phalcon\CLI\Task {

    var $debug = true;

    public function mainAction() {
        $cacheFolder = APPLICATION_PATH . '/cache/trmc.aec.gov.tw/' . date('Y-m-d');
        $dataFolder = APPLICATION_PATH . '/cache/trmc.aec.gov.tw/' . date('Y-m-d') . '/data';
        if (!file_exists($dataFolder)) {
            mkdir($dataFolder, 0777, true);
        }
        $baseUrl = 'http://rmsp.trmc.aec.gov.tw/user/view_monitor.asp?c2e=&monitor_title=&monitor_no=';
        $points = array();
        for ($i = 1; $i <= 99; $i++) {
            $key = str_pad($i, 2, '0', STR_PAD_LEFT);
            $url = $baseUrl . $key;
            $localCachedFile = $dataFolder . '/' . $this->localFileName($url);
            $page = $this->getFileContent($localCachedFile, $url);
            if (strlen($page) > 0) {
                $points[$key] = array();
                $page = mb_convert_encoding($page, 'utf-8', 'big5');
                $pageParts = explode('<font size="3">', $page);
                $pageParts = explode('</font>', $pageParts[1]);
                $points[$key]['title'] = trim($pageParts[0]);
                $pageParts = explode('map.setCenter(new GLatLng(', $page);
                $pageParts = explode('), 15);', $pageParts[1]);
                $latlng = explode(',', $pageParts[0]);
                $points[$key]['latitude'] = trim($latlng[0]);
                $points[$key]['longitude'] = trim($latlng[1]);
            }
        }

        $valueSource = 'http://www.trmc.aec.gov.tw/utf8/showmap/taiwan_out.php';
        $localCachedFile = $dataFolder . '/' . $this->localFileName($valueSource);
        $map = $this->getFileContent($localCachedFile, $valueSource);
        $offset = 0;
        $jsPos = strpos($map, 'popupwindow(\'', $offset);
        while (false !== $jsPos) {
            $keyPosEnd = strpos($map, ',', $jsPos);
            $key = substr($map, $jsPos + 13, 2);
            if (!isset($points[$key])) {
                $points[$key] = array();
            }
            $valuePosBegin = strpos($map, '<td align="right" class="blue13">', $jsPos);
            $valuePosEnd = strpos($map, '</td>', $valuePosBegin) + 5;
            $points[$key]['value'] = trim(strip_tags(substr($map, $valuePosBegin, $valuePosEnd - $valuePosBegin)));
            //<span class="gray12"></span>
            $valuePosBegin = strpos($map, '<span class="gray12">', $jsPos);
            $valuePosEnd = strpos($map, '</span>', $valuePosBegin) + 7;
            $points[$key]['date'] = trim(strip_tags(substr($map, $valuePosBegin, $valuePosEnd - $valuePosBegin)));

            //next loop
            $offset = $valuePosEnd;
            $jsPos = strpos($map, 'popupwindow(\'', $offset);
        }
        file_put_contents(dirname(APPLICATION_PATH) . '/public/files/trmc.aec.gov.tw.json', json_encode($points));
    }

    private function getFileContent($localFile, $remoteFile) {
        if (!file_exists($localFile)) {
            if (true === $this->debug) {
                echo "getting remote file: {$remoteFile}\n";
            }
            file_put_contents($localFile, file_get_contents($this->fixUrl($remoteFile)));
        }
        return file_exists($localFile) ? file_get_contents($localFile) : '';
    }

    private function localFileName($url) {
        $fileName = str_replace(array('/', 'http:', 'https:', '?', '&'), array('_', '', '', '_', '_'), $url);
        if (true === $this->debug) {
            echo "rename {$url} to {$fileName}\n";
        }
        return $fileName;
    }

    private function fixUrl($url) {
        //ref: http://ubuntu-rubyonrails.blogspot.tw/2009/06/unicode.html
        preg_match_all('/[\x{2E80}-\x{9FFF}]+/u', $url, $matches, PREG_OFFSET_CAPTURE);
        if (!empty($matches[0])) {
            $newUrl = '';
            $urlOffset = 0;
            foreach ($matches[0] AS $match) {
                $newUrl .= substr($url, $urlOffset, $match[1] - $urlOffset);
                $newUrl .= urlencode($match[0]);
                $urlOffset = $match[1] + strlen($match[0]);
            }
            $url = $newUrl . substr($url, $urlOffset);
        }
        return $url;
    }

}
