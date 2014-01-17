<?php

class EmergencyTask extends \Phalcon\CLI\Task {

    var $debug = true;
    var $sources = array(
        array(
            'title' => '國立台灣大學醫學院附設醫院',
            'url' => 'http://www.ntuh.gov.tw/information/publicInfo/%E6%80%A5%E8%A8%BA%E5%8D%B3%E6%99%82%E8%B3%87%E8%A8%8A.aspx',
        ),
        array(
            'title' => '台北長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=1',
        ),
        array(
            'title' => '基隆長庚紀念醫院暨情人湖院區',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=2',
        ),
        array(
            'title' => '林口長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=3',
        ),
        array(
            'title' => '嘉義長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=6',
        ),
        array(
            'title' => '長庚醫療財團法人高雄長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=8',
        ),
        array(
            'title' => '雲林長庚紀念醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=M',
        ),
        array(
            'title' => '高雄市立鳳山醫院',
            'url' => 'https://www.cgmh.org.tw/bed/erd/index.asp?loc=T',
        ),
        array(
            'title' => '臺北榮民總醫院',
            'url' => 'http://www.vghtpe.gov.tw/ser.html',
        ),
        array(
            'title' => '三軍總醫院附設民眾診療服務處',
            'url' => 'http://www1.ndmctsgh.edu.tw/ErOnlineNews/ErOnLineData.aspx',
        ),
        array(
            'title' => '財團法人臺灣基督長老教會馬偕紀念社會事業基金會馬偕紀念醫院',
            'url' => 'https://trns.mmh.org.tw/WebEMR/Default.aspx',
        ),
        array(
            'title' => '新光醫療財團法人新光吳火獅紀念醫院',
            'url' => 'https://regis.skh.org.tw/ERONLINE/INDEX.aspx',
        ),
        array(
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
        foreach($this->sources AS $source) {
            $localFile = $cacheFolder . '/' . $this->localFileName($source['url']);
            $page = $this->getFileContent($localFile, $source['url']);
        }
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
