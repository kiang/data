<?php

class EmergencyTask extends \Phalcon\CLI\Task {

    var $debug = true;
    var $sources = array(
        array(
            'parser' => 'parserA',
            'title' => '國立台灣大學醫學院附設醫院',
            'url' => 'https://reg.ntuh.gov.tw/EmgInfoBoard/NTUHEmgInfo.aspx',
        ),
        array(
            'parser' => 'parserB',
            'title' => '台北長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=1',
        ),
        array(
            'parser' => 'parserB',
            'title' => '基隆長庚紀念醫院暨情人湖院區',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=2',
        ),
        array(
            'parser' => 'parserB',
            'title' => '林口長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=3',
        ),
        array(
            'parser' => 'parserB',
            'title' => '嘉義長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=6',
        ),
        array(
            'parser' => 'parserB',
            'title' => '長庚醫療財團法人高雄長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=8',
        ),
        array(
            'parser' => 'parserB',
            'title' => '雲林長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=M',
        ),
        array(
            'parser' => 'parserB',
            'title' => '高雄市立鳳山醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=T',
        ),
        array(
            'parser' => 'parserC',
            'title' => '臺北榮民總醫院',
            'url' => 'https://www6.vghtpe.gov.tw/ERREALIFO/ERREALIFO.jsp',
        ),
        array(
            'parser' => 'parserD',
            'title' => '三軍總醫院附設民眾診療服務處',
            'url' => 'http://www1.ndmctsgh.edu.tw/ErOnlineNews/ErOnLineData.aspx',
        ),
        array(
            'parser' => 'parserE',
            'title' => '財團法人臺灣基督長老教會馬偕紀念社會事業基金會馬偕紀念醫院',
            'url' => 'https://trns.mmh.org.tw/WebEMR/Default.aspx',
        ),
        array(
            'parser' => 'parserF',
            'title' => '新光醫療財團法人新光吳火獅紀念醫院',
            'url' => 'https://regis.skh.org.tw/ERONLINE/INDEX.aspx',
        ),
        array(
            'parser' => 'parserG',
            'title' => '臺北市立萬芳醫院',
            'url' => 'http://www.wanfang.gov.tw/W402008web_new/epd_query.asp',
        ),
        array(
            'title' => '國泰醫療財團法人國泰綜合醫院',
            'url' => 'http://med.cgh.org.tw/unit/branch/Pharmacy/ebl/RealTimeInfoHQ.html',
        ),
        array(
            'title' => '佛教慈濟醫療財團法人台北慈濟醫院急診即時資訊',
            'url' => 'http://app.tzuchi.com.tw/tchw/ERInfo/ERInformation.aspx',
        ),
        array(
            'title' => '衛生福利部雙和醫院（委託臺北醫學大學興建經營）急診即時資訊',
            'url' => 'http://eng.shh.org.tw/',
        ),
        array(
            'title' => '醫療財團法人徐元智先生醫藥基金會亞東紀念醫院急診即時資訊',
            'url' => 'http://www.femh.org.tw/research/news_op.aspx',
        ),
        array(
            'title' => '臺中榮民總醫院',
            'url' => 'http://www.vghtc.gov.tw/GipOpenWeb/wSite/sp?xdUrl=/wSite/query/Doctor/GetEmgBedInform.jsp&ctNode=55658&mp=1&idPath=213_55658',
        ),
        array(
            'title' => '光田醫療社團法人光田綜合醫院(沙鹿總院) ',
            'url' => 'http://www.ktgh.com.tw/BednoInfo_Show.asp?CatID=80&ModuleType=Y',
        ),
        array(
            'title' => '光田醫療社團法人光田綜合醫院(大甲院區)',
            'url' => 'http://www.ktgh.com.tw/BednoInfo_Show.asp?CatID=81&ModuleType=Y',
        ),
        array(
            'title' => '中國醫藥大學附設醫院',
            'url' => 'http://61.66.117.8/EmrCount/Default.aspx',
        ),
        array(
            'title' => '中山醫學大學附設醫院',
            'url' => 'http://www.csh.org.tw/ER/index.aspx',
        ),
        array(
            'title' => '童綜合醫院',
            'url' => 'http://www.sltung.com.tw/tw/BED/bed.html',
        ),
        array(
            'title' => '成大醫院',
            'url' => 'http://www.hosp.ncku.edu.tw/nckm/ER/default.aspx',
        ),
        array(
            'title' => '奇美醫院',
            'url' => 'http://www.chimei.org.tw/%E6%80%A5%E8%A8%BA%E5%8D%B3%E6%99%82%E8%A8%8A%E6%81%AF/main.aspx?ihosp=10',
        ),
        array(
            'title' => '高雄榮民總醫院',
            'url' => 'http://cms03p.vghks.gov.tw/Chinese/MainSite/',
        ),
        array(
            'title' => '高雄醫學大學附設中和紀念醫院',
            'url' => 'http://www.kmuh.org.tw/KMUHWeb/Pages/P04MedService/ERStatus.aspx',
        ),
        array(
            'title' => '義大醫療財團法人義大醫院',
            'url' => 'http://www.edah.org.tw/index.asp?set=9462',
        ),
    );

    public function mainAction() {
        $cacheFolder = APPLICATION_PATH . '/cache/hospitals/' . date('Y-m-d');
        $dataFolder = APPLICATION_PATH . '/cache/hospitals/' . date('Y-m-d') . '/data';
        if (!file_exists($dataFolder)) {
            mkdir($dataFolder, 0777, true);
        }
        $result = $this->sources;
        foreach ($result AS $key => $source) {
            $localFile = $cacheFolder . '/' . $this->localFileName($source['url']);
            $page = $this->getFileContent($localFile, $source['url']);
            if (isset($source['parser'])) {
                $result[$key]['info'] = $this->{$source['parser']}($page);
            }
        }
        print_r($result);
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

    private function parserA($page) {
        $offset = strpos($page, '<table') + 1;
        $offset = strpos($page, '>', $offset) + 1;
        $bodyEnd = strpos($page, '</table>', $offset);
        $content = substr($page, $offset, $bodyEnd - $offset);
        $lines = explode("\n", strip_tags($content));
        foreach ($lines AS $key => $val) {
            $lines[$key] = explode('：', trim($val));
        }
        return array(
            $lines[2][0] => $lines[3][0],
            $lines[6][0] => $lines[7][0],
            $lines[11][0] => $lines[12][0],
            $lines[15][0] => $lines[16][0],
            $lines[19][0] => $lines[20][0],
            $lines[23][0] => $lines[23][1],
        );
    }

    private function parserB($page) {
        $offset = strpos($page, '<table width="0" border="1" cellpadding="5" cellspacing="0" class="font15-22">') + 79;
        $bodyEnd = strpos($page, '</table>', $offset);
        $content = substr($page, $offset, $bodyEnd - $offset);
        $content = mb_convert_encoding($content, 'utf-8', 'big5');
        $parts = explode('</td>', $content);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        $timeParts = explode('：', $parts[0]);
        return array(
            '已向119通報滿床(載)' => $parts[4],
            '等待看診人數' => $parts[6],
            '等待推床人數' => $parts[8],
            '等待住院人數' => $parts[10],
            '等待加護住院人數' => $parts[12],
            '更新時間' => trim($timeParts[1]),
        );
    }

    private function parserC($page) {
        $offset = strpos($page, '<table') + 1;
        $offset = strpos($page, '>', $offset) + 1;
        $bodyEnd = strpos($page, '</body>', $offset);
        $content = substr($page, $offset, $bodyEnd - $offset);
        $content = str_replace(array('<!--', '-->'), '', $content);
        $content = mb_convert_encoding($content, 'utf-8', 'big5');
        $lines = explode("\n", strip_tags($content));
        foreach ($lines AS $key => $val) {
            $lines[$key] = trim($val);
        }
        $timePos = strpos($lines[30], ' ');
        return array(
            $lines[3] => $lines[5],
            $lines[9] => $lines[10],
            $lines[13] => $lines[14],
            $lines[17] => $lines[18],
            $lines[21] => $lines[22],
            substr($lines[30], 0, $timePos) => substr($lines[30], $timePos + 1),
        );
    }

    private function parserD($page) {
        $parts = explode('</td>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        return array(
            $parts[2] => $parts[3],
            $parts[4] => $parts[5],
            $parts[6] => $parts[7],
            $parts[8] => $parts[9],
            $parts[10] => $parts[11],
        );
    }

    private function parserE($page) {
        $parts = explode('</td>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = explode('：', trim(strip_tags($val)));
        }
        return array(
            '訊息時間' => $parts[1][0],
            $parts[2][0] => $parts[3][0],
            $parts[4][0] => $parts[5][0],
            $parts[6][0] => $parts[7][0],
            $parts[6][0] => $parts[7][0],
            $parts[8][0] => $parts[9][0],
            $parts[10][0] => $parts[11][0],
        );
    }

    private function parserF($page) {
        $parts = explode('</td>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        return array(
            '已向119通報滿床(載)' => $parts[1] === '已向119通報滿床(載)' ? '是' : '否',
            '等待候診人數[內科]' => intval($parts[6]),
            '等待候診人數[外科]' => intval($parts[10]),
            '等待候診人數[小兒科]' => intval($parts[11]),
            '等待推床人數' => intval($parts[7]),
            '等待住院人數' => intval($parts[8]),
            '等待ICU人數' => intval($parts[9]),
        );
    }
    
    private function parserG($page) {
        $offset = strpos($page, '<div class="h1"><img');
        $bodyEnd = strpos($page, '<img src="images/content/spacer.gif" width="1" height="540" border="0" alt="" />', $offset);
        $content = substr($page, $offset, $bodyEnd - $offset);
        $content = strip_tags(mb_convert_encoding($content, 'utf-8', 'big5'));
        $lines = explode("\n", $content);
        foreach($lines AS $key => $val) {
            $lines[$key] = explode('：', trim($val));
        }
        $timeParts = explode(':', $lines[20][0]);
        return array(
            $lines[3][0] => $lines[3][1],
            $lines[4][0] => $lines[4][1],
            $lines[5][0] => $lines[5][1],
            $lines[6][0] => $lines[6][1],
            $lines[7][0] => $lines[7][1],
            $timeParts[0] => $timeParts[1] . ':' . intval($lines[20][1]),
        );
    }

}