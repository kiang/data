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
            'parser' => 'parserH',
            'title' => '國泰醫療財團法人國泰綜合醫院',
            'url' => 'http://med.cgh.org.tw/unit/branch/Pharmacy/ebl/RealTimeInfoHQ.html',
        ),
        array(
            'parser' => 'parserI',
            'title' => '佛教慈濟醫療財團法人台北慈濟醫院急診即時資訊',
            'url' => 'http://app.tzuchi.com.tw/tchw/ERInfo/ERInformation.aspx',
        ),
        array(
            'parser' => 'parserJ',
            'title' => '衛生福利部雙和醫院（委託臺北醫學大學興建經營）急診即時資訊',
            'url' => 'http://eng.shh.org.tw/',
        ),
        array(
            'parser' => 'parserK',
            'title' => '醫療財團法人徐元智先生醫藥基金會亞東紀念醫院急診即時資訊',
            'url' => 'http://www.femh.org.tw/research/news_op.aspx',
        ),
        array(
            'parser' => 'parserL',
            'title' => '臺中榮民總醫院',
            'url' => 'http://www.vghtc.gov.tw/GipOpenWeb/wSite/sp?xdUrl=/wSite/query/Doctor/GetEmgBedInform.jsp&ctNode=55658&mp=1&idPath=213_55658',
        ),
        array(
            'parser' => 'parserM',
            'title' => '光田醫療社團法人光田綜合醫院(沙鹿總院) ',
            'url' => 'http://www.ktgh.com.tw/BednoInfo_Show.asp?CatID=80&ModuleType=Y',
        ),
        array(
            'parser' => 'parserM',
            'title' => '光田醫療社團法人光田綜合醫院(大甲院區)',
            'url' => 'http://www.ktgh.com.tw/BednoInfo_Show.asp?CatID=81&ModuleType=Y',
        ),
        array(
            'parser' => 'parserN',
            'title' => '中國醫藥大學附設醫院',
            'url' => 'http://61.66.117.8/EmrCount/Default.aspx',
        ),
        array(
            'parser' => 'parserO',
            'title' => '中山醫學大學附設醫院',
            'url' => 'http://www.csh.org.tw/ER/index.aspx',
        ),
        array(
            'parser' => 'parserP',
            'title' => '童綜合醫院',
            'url' => 'http://www.sltung.com.tw/tw/BED/bed.html',
        ),
        array(
            'parser' => 'parserQ',
            'title' => '成大醫院',
            'url' => 'http://www.hosp.ncku.edu.tw/nckm/ER/default.aspx',
        ),
        array(
            'parser' => 'parserR',
            'title' => '永康奇美醫院',
            'url' => 'http://www.chimei.org.tw/%E6%80%A5%E8%A8%BA%E5%8D%B3%E6%99%82%E8%A8%8A%E6%81%AF/main.aspx?ihosp=10',
        ),
        array(
            'parser' => 'parserS',
            'title' => '柳營奇美醫院',
            'url' => 'http://www.chimei.org.tw/%E6%80%A5%E8%A8%BA%E5%8D%B3%E6%99%82%E8%A8%8A%E6%81%AF/main.aspx?ihosp=10',
        ),
        array(
            'parser' => 'parserT',
            'title' => '佳里奇美醫院',
            'url' => 'http://www.chimei.org.tw/%E6%80%A5%E8%A8%BA%E5%8D%B3%E6%99%82%E8%A8%8A%E6%81%AF/main.aspx?ihosp=10',
        ),
        array(
            'parser' => 'parserU',
            'title' => '高雄醫學大學附設中和紀念醫院',
            'url' => 'http://www.kmuh.org.tw/KMUHWeb/Pages/P04MedService/ERStatus.aspx',
        ),
        array(
            'parser' => 'parserV',
            'title' => '義大醫療財團法人義大醫院',
            'url' => 'http://www3.edah.org.tw/E-DA/WebRegister/ProcessEmeInf.jsp',
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
        file_put_contents(dirname(APPLICATION_PATH) . '/public/files/emergency.json', json_encode($result));
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
    
    private function parserH($page) {
        $page = mb_convert_encoding($page, 'utf-8', 'big5');
        $parts = explode('</td>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = explode('：', trim(strip_tags($val)));
        }
        return array(
            $parts[1][0] => $parts[2][0],
            $parts[5][0] => $parts[6][0],
            $parts[9][0] => $parts[10][0],
            $parts[13][0] => $parts[14][0],
            $parts[17][0] => $parts[18][0],
            $parts[20][0] => $parts[20][1] . ':' . $parts[20][2],
        );
    }
    
    private function parserI($page) {
        $parts = preg_split('/<\\/t[dh]>/', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        return array(
            '已向119通報滿床(載)' => $parts[13] === '未向119通報滿床' ? '否' : '是',
            $parts[2] => $parts[7],
            $parts[3] => $parts[8],
            $parts[4] => $parts[9],
            $parts[5] => $parts[10],
            $parts[6] => $parts[11],
        );
    }
    
    private function parserJ($page) {
        $parts = preg_split('/<\\/t[dh]>/', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        $timeParts = explode(':', $parts[11]);
        $timeParts[3] = substr($timeParts[3], 0, 2);
        return array(
            $parts[1] => $parts[2],
            $parts[3] => $parts[4],
            $parts[5] => $parts[6],
            $parts[7] => $parts[8],
            $timeParts[0] => date('Y-m-d ') . implode(':', array($timeParts[1], $timeParts[2], $timeParts[3])),
        );
    }
    
    private function parserK($page) {
        $offset = strpos($page, '<span class="magazine_title">亞東紀念醫院');
        $offset = strrpos($page, '<table width="725" border="0" cellspacing="0" cellpadding="0">', strlen($page) - $offset);
        $bodyEnd = strpos($page, '<!-- page-->', $offset);
        $content = substr($page, $offset, $bodyEnd - $offset);
        $content = str_replace('&nbsp;', '', $content);
        $parts = explode('</span>', $content);
        foreach ($parts AS $key => $val) {
            $parts[$key] = explode('：', trim(strip_tags($val)));
            $parts[$key][0] = explode('.', $parts[$key][0]);
        }
        return array(
            $parts[1][0][0] => $parts[1][1],
            $parts[2][0][1] => $parts[2][1],
            $parts[3][0][1] => $parts[3][1],
            $parts[4][0][1] => $parts[4][1],
            $parts[5][0][1] => $parts[5][1],
            $parts[6][0][1] => $parts[6][1],
        );
    }
    
    private function parserL($page) {
        $offset = strpos($page, '<div class="cp">');
        $bodyEnd = strpos($page, '<div class="quickLink">', $offset);
        $content = substr($page, $offset, $bodyEnd - $offset);
        $parts = explode('</td>', $content);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        return array(
            $parts[1] => $parts[2],
            $parts[4] => $parts[5],
            $parts[6] => $parts[7],
            $parts[8] => $parts[9],
            $parts[11] => $parts[12],
            $parts[14] => $parts[15],
            $parts[17] => $parts[18],
        );
    }
    
    private function parserM($page) {
        $page = mb_convert_encoding($page, 'utf-8', 'big5');
        $offset = strpos($page, '急診即時資訊公告');
        $offset = strpos($page, '<table', $offset);
        $bodyEnd = strpos($page, '</table>', $offset);
        $content = substr($page, $offset, $bodyEnd - $offset);
        $parts = preg_split('/<\\/t[dh]>/', $content);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        return array(
            $parts[0] => (false === strpos($page, '<td style="color:#e7e7e7;"')) ? '是' : '否',
            $parts[1] => $parts[6],
            $parts[2] => $parts[7],
            $parts[3] => $parts[8],
            $parts[4] => $parts[9],
        );
    }
    
    private function parserN($page) {
        $page = substr($page, strpos($page, '<table'));
        $parts = explode('</td>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = explode('：', trim(strip_tags($val)));
            $parts[$key][0] = explode('. ', $parts[$key][0]);
        }
        return array(
            $parts[0][0][1] => $parts[1][0][0],
            $parts[2][0][1] => $parts[3][0][0],
            $parts[4][0][1] => $parts[5][0][0],
            $parts[6][0][1] => $parts[7][0][0],
            $parts[8][0][1] => $parts[9][0][0],
            $parts[10][0][0] => $parts[10][1],
        );
    }
    
    private function parserO($page) {
        $page = substr($page, strpos($page, '<table'));
        $parts = explode('</td>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        $timeParts = explode('：', $parts[21]);
        return array(
            '已向119通報滿床(載)' => $parts[20],
            '等待看診人數' => $parts[2],
            '等待推床人數' => $parts[4],
            '等待住院人數' => $parts[6],
            '等待加護住院人數' => $parts[18],
            '更新時間' => trim($timeParts[1]),
        );
    }
    
    private function parserP($page) {
        $page = mb_convert_encoding($page, 'utf-8', 'big5');
        $parts = explode('<BR><BR>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = explode('：', trim(strip_tags($val)));
            $parts[$key][0] = explode('.', $parts[$key][0]);
        }
        $parts[4][1] = explode("\n", $parts[4][1]);
        $parts[4][1][3] = explode(' : ', $parts[4][1][3]);
        return array(
            $parts[0][0][1] => $parts[0][1],
            $parts[1][0][1] => $parts[1][1],
            $parts[2][0][1] => $parts[2][1],
            $parts[3][0][1] => $parts[3][1],
            $parts[4][0][1] => $parts[4][1][0],
            $parts[4][1][3][0] => $parts[4][1][3][1],
        );
    }
    
    private function parserQ($page) {
        $page = substr($page, strpos($page, '<table'));
        $parts = explode('</td>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        $parts[0] = explode('（', $parts[0]);
        $parts[0][1] = explode('：', $parts[0][1]);
        $parts[0][1][1] = explode('）', $parts[0][1][1]);
        $parts[14] = explode('：', $parts[14]);
        $parts[14][1] = trim($parts[14][1]);
        return array(
            $parts[2] => $parts[3],
            $parts[5] => $parts[6],
            $parts[8] => $parts[9],
            $parts[11] => $parts[12],
            $parts[14][0] => $parts[14][1],
            $parts[0][1][0] => $parts[0][1][1][0],
        );
    }
    
    private function parserR($page) {
        $page = substr($page, strpos($page, '<table'));
        $parts = preg_split('/<\\/t[dh]>/', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        $parts[0] = explode("\n", $parts[0]);
        $parts[0][3] = trim($parts[0][3]);
        $parts[0][6] = trim($parts[0][6]);
        $parts[1] = explode("\n", $parts[1]);
        $parts[1][4] = trim($parts[1][4]);
        return array(
            $parts[0][3] => $parts[0][6],
            $parts[1][4] => $parts[8],
            $parts[2] => $parts[9],
            $parts[3] => $parts[10],
            $parts[4] => $parts[11],
            $parts[5] => $parts[12],
            $parts[6] => $parts[13],
            $parts[7] => $parts[14],
        );
    }
    
    private function parserS($page) {
        $page = substr($page, strpos($page, '<table'));
        $parts = preg_split('/<\\/t[dh]>/', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        $parts[0] = explode("\n", $parts[0]);
        $parts[0][3] = trim($parts[0][3]);
        $parts[0][6] = trim($parts[0][6]);
        $parts[15] = explode("\n", $parts[15]);
        $parts[15][4] = trim($parts[15][4]);
        return array(
            $parts[0][3] => $parts[0][6],
            $parts[15][4] => $parts[22],
            $parts[16] => $parts[23],
            $parts[17] => $parts[24],
            $parts[18] => $parts[25],
            $parts[19] => $parts[26],
            $parts[20] => $parts[27],
            $parts[21] => $parts[28],
        );
    }
    
    private function parserT($page) {
        $page = substr($page, strpos($page, '<table'));
        $parts = preg_split('/<\\/t[dh]>/', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = trim(strip_tags($val));
        }
        $parts[0] = explode("\n", $parts[0]);
        $parts[0][3] = trim($parts[0][3]);
        $parts[0][6] = trim($parts[0][6]);
        $parts[29] = explode("\n", $parts[29]);
        $parts[29][4] = trim($parts[29][4]);
        return array(
            $parts[0][3] => $parts[0][6],
            $parts[29][4] => $parts[36],
            $parts[30] => $parts[37],
            $parts[31] => $parts[38],
            $parts[32] => $parts[39],
            $parts[33] => $parts[40],
            $parts[34] => $parts[41],
            $parts[35] => $parts[42],
        );
    }
    
    private function parserU($page) {
        $page = substr($page, strpos($page, '<form'));
        $parts = explode('</td>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = explode('：', trim(strip_tags($val)));
        }
        $timeParts = explode("\n", $parts[0][0]);;
        $timeParts[4] = explode('&nbsp;', $timeParts[4]);
        return array(
            '通報滿載' => $parts[1][0],
            $parts[2][0] => $parts[3][0],
            $parts[4][0] => $parts[5][0],
            $parts[6][0] => $parts[7][0],
            $parts[8][0] => $parts[9][0],
            '更新時間' => trim($timeParts[4][0]),
        );
    }
    
    private function parserV($page) {
        $page = mb_convert_encoding($page, 'utf-8', 'big5');
        $parts = explode('</td>', $page);
        foreach ($parts AS $key => $val) {
            $parts[$key] = explode('：', trim(strip_tags($val)));
            $parts[$key][0] = explode('.', $parts[$key][0]);
        }
        return array(
            $parts[0][0][1] => $parts[0][1],
            $parts[1][0][1] => $parts[1][1],
            $parts[2][0][1] => $parts[2][1],
            $parts[3][0][1] => $parts[3][1],
            $parts[4][0][1] => $parts[4][1],
        );
    }

}