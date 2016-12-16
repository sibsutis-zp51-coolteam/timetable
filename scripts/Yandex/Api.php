<?php

namespace Yandex;

/**
 * Выполняет запросы к API Яндекс
 */
class Api
{
    /**
     * Путь к API
     */
    const API_URL = "https://api.rasp.yandex.net/v1.0/";

    /**
     * Возвращает JSON как массив
     */
    const JSON_AS_ARRAY = true;

    /**
     * Возвращает результат вызова API
     *
     * @param string $endpoint название endpoint
     * @param array $params массив параметров
     *
     * @return array
     */
    public function call($endpoint, $params)
    {
        $params = array_merge(['lang' => 'ru', 'format' => 'json', 'apikey' => API_KEY], $params);
        $url = self::API_URL . $endpoint . "/?" . http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $result = json_decode($response, self::JSON_AS_ARRAY);

        if (json_last_error()) {
            throw new Exception('Не удается прочитать JSON');
        }

        return $result;
    }
}
