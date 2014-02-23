<?php

class Moek1Task extends \Phalcon\CLI\Task {

    var $debug = true;

    public function mainAction() {
        $listUrl = 'https://stats.moe.gov.tw/files/school/102/k1_new.txt';
        $dataFolder = APPLICATION_PATH . '/cache/data.gov.tw/' . date('Y-m-d') . '/data';
        if (!file_exists($dataFolder)) {
            mkdir($dataFolder, 0777, true);
        }
        $cacheFolder = APPLICATION_PATH . '/cache/stats.moe.gov.tw/' . date('Y-m-d');
        $listFile = $cacheFolder . '/' . $this->localFileName($listUrl);
        if (!file_exists($listFile)) {
            file_put_contents($listFile, mb_convert_encoding(file_get_contents($listUrl), 'utf-8', 'utf-16'));
        }
        $fh = fopen($listFile, 'r');
        $lineNo = 0;
        $points = array();
        while ($line = fgetcsv($fh, 2048, "\t")) {
            ++$lineNo;
            if ($lineNo < 3)
                continue;
            switch ($lineNo) {
                case 3:
                    continue;
                    break;
                default:
                    $c3len = strlen($line[3]);
                    if($c3len <= 0) continue;
                    $c4pos = strpos($line[4], $line[3]) + $c3len;
                    $kPos = strpos($line[4], '鄰', $c4pos);
                    if (false !== $kPos) {
                        $c4pos = $kPos + 3;
                    }
                    $c4pos2 = strpos($line[4], '號', $c4pos) + 3;
                    $line[6] = substr($line[2], 4) . $line[3] . substr($line[4], $c4pos, $c4pos2 - $c4pos);
                    $line[7] = substr($line[4], 1, 3);
                    $line[4] = substr($line[4], 5);
                    $line[2] = substr($line[2], 4);
                    $points[] = array(
                        'gid' => $line[0],
                        'title' => $line[1],
                        'phone' => $line[5],
                        'city' => $line[2],
                        'subcity' => $line[3],
                        'postcode' => $line[7],
                        'full_address' => $line[4],
                        'map_address' => $line[6],
                    );
            }
        }
        file_put_contents(dirname(APPLICATION_PATH) . '/public/files/k1.stats.moe.gov.tw.json', json_encode($points));
    }

    private function localFileName($url) {
        $fileName = str_replace(array('/', 'http:', 'https:', '?', '&'), array('_', '', '', '_', '_'), $url);
        if (true === $this->debug) {
            echo "rename {$url} to {$fileName}\n";
        }
        return $fileName;
    }

}
