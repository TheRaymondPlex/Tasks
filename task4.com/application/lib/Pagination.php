<?php

namespace application\lib;

class Pagination
{
    public static function getAmountOfPages()
    {
        $curl = curl_init(getenv('API') . '?access-token=' . getenv('ACCESS_TOKEN'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        $result = curl_exec($curl);

        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headerStr = substr($result, 0, $headerSize);
        curl_close($curl);

        $headers = self::headersToArray($headerStr);

        return $headers['x-pagination-pages'];
    }

    private static function headersToArray($str): array
    {
        $headers = array();
        $headersTmpArray = explode("\r\n", $str);
        for ($i = 0; $i < count($headersTmpArray); ++$i) {
            if (strlen($headersTmpArray[$i]) > 0) {
                if (strpos($headersTmpArray[$i], ":")) {
                    $headerName = substr($headersTmpArray[$i], 0, strpos($headersTmpArray[$i], ":"));
                    $headerValue = substr($headersTmpArray[$i], strpos($headersTmpArray[$i], ":") + 1);
                    $headers[$headerName] = $headerValue;
                }
            }
        }

        return $headers;
    }


}