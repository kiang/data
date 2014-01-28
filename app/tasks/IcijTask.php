<?php

class IcijTask extends \Phalcon\CLI\Task {

    public function mainAction() {
        $files = array(
            'countries' => APPLICATION_PATH . '/../public/files/icij_csv/countriesNW.csv',
            /*
             * [0] => country_id
             * [1] => country_code
             * [2] => country_name
             */
            'edges' => APPLICATION_PATH . '/../public/files/icij_csv/edges_1DNW.csv',
            /*
             * [0] => Unique_ID
             * [1] => Entity_ID1
             * [2] => Entity_ID2
             * [3] => description_
             * [4] => date_from
             * [5] => date_to
             * [6] => direction
             * [7] => chinesePos
             * [8] => linkType
             */
            'node_countries' => APPLICATION_PATH . '/../public/files/icij_csv/node_countriesNW.csv',
            /*
             * [0] => NODEID1
             * [1] => country_code
             * [2] => country_name
             * [3] => country_id
             */
            'nodes' => APPLICATION_PATH . '/../public/files/icij_csv/nodesNW.csv',
            /*
             * [0] => Unique_ID
             * [1] => subtypes_
             * [2] => Description_
             * [3] => searchField_
             * [4] => status
             * [5] => desc_status
             * [6] => type
             * [7] => desc_company_type
             * [8] => inc_dat
             * [9] => dorm_dat
             * [10] => juris
             * [11] => desc_jurisdiction
             * [12] => completeAddresses
             * [13] => agencyID
             * [14] => tax_stat
             * [15] => tax_stat_description
             */
        );
        $taiwanNodes = array();
        $fh = fopen($files['node_countries'], 'r');
        $firstLineProcessed = false;
        while ($line = fgetcsv($fh, 2048, ';')) {
            if (false === $firstLineProcessed) {
                $firstLineProcessed = true;
                continue;
            }
            if($line[3] == '241') {
                $taiwanNodes[$line[0]] = array();
            }
        }
        fclose($fh);
        $fh = fopen($files['nodes'], 'r');
        $firstLineProcessed = false;
        $fields = array();
        while ($line = fgetcsv($fh, 2048, ';', '"', chr(13))) {
            if (false === $firstLineProcessed) {
                $firstLineProcessed = true;
                $fields = $line;
                $fieldsCount = count($fields);
                continue;
            }
            if(isset($taiwanNodes[$line[0]])) {
                $taiwanNodes[$line[0]][] = array_combine($fields, $line);
            }
        }
        fclose($fh);
        $fh = fopen($files['edges'], 'r');
        $firstLineProcessed = false;
        $fields = array();
        while ($line = fgetcsv($fh, 2048, ';')) {
            if (false === $firstLineProcessed) {
                $firstLineProcessed = true;
                $fields = $line;
                continue;
            }
            if(isset($taiwanNodes[$line[1]])) {
                $taiwanNodes[$line[2]][] = array_combine($fields, $line);
            }
            if(isset($taiwanNodes[$line[2]])) {
                $taiwanNodes[$line[2]][] = array_combine($fields, $line);
            }
        }
        fclose($fh);
        print_r($taiwanNodes);
    }

}
