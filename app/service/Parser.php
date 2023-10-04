<?php

namespace service;

use Exception;

class Parser
{

    /**
     * Обход страниц
     * @throws Exception
     */
    public function parse(): array {

        $days = $this->getDays();
        $array = [];
        foreach ($days as $day) {
            $xml = file_get_contents($_ENV['URL'] . '?' . http_build_query(['date_req' => $day]));
            var_dump($_ENV['URL'] . '?' . http_build_query(['date_req' => $day]));
            $array += $this->objectsIntoArray($xml, $day);
            sleep(1);
        }
        return $array;
    }


    /**
     * Разобрать xml
     * @param  string  $xmlString
     * @param $day
     * @return array
     */
    private function objectsIntoArray(string $xmlString, $day): array
    {
        $xml = simplexml_load_string($xmlString);

        $children  = $xml->children();
        $array[$day] = [];
        foreach ($children as $child) {
            $char_code = ((array) $child->CharCode)[0];
            if(in_array($char_code,  ['EUR', 'USD', 'KGS'])) {
                $array[$day][] =  $char_code . '=' . ((array) $child->Value)[0];
            }
        }
        return $array;
    }

    /**
     * Получить все дни начиная с прошлого понедельника
     * @return array
     */
    private function getDays(): array {
        $current = date('Y-m-d');
        $monday = date('Y-m-d', strtotime('last week Monday'));
        $stop_date = date('Y-m-d', strtotime($monday . ' +1 day'));
        $days = [$monday];
        while($stop_date <= $current) {
            $days[] = $stop_date;
            $stop_date = date('Y-m-d', strtotime($stop_date . ' +1 day'));
        }
        return $days;
    }

}