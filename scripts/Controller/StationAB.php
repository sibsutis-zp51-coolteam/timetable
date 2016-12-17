<?php

namespace Controller;

/**
 * Класс с расписанием станций
 */
class StationAB
{
    /**
     * Класс парсит расписания поездов из пункта А в пункт В
     *
     * @param stringFrom $station код станции отправления
     * @param stringTo $station код станции назначения
     * @param string $date дата расписания
     * @return array
     */
    public function stationAB($stationFrom = null, $stationTo = null, $date = null)
    {

        if (empty($date)) {
            $date = date("Y-m-d");      // Если пустой, используем текущую дату
        } elseif ($date == 'all') {
            $date = null;
        }

        if (empty($stationFrom)) {
            $stationFrom = "s9610189";
            // Если пустой, используем станцию Новосибирск-главный
        }

        if (empty($stationTo)) {
            $stationTo = "s9610460";
            // Если пустой, используем станцию Сибирская
        }

        $api = new \Yandex\Api();


        $params = [
            "date" => $date,
            "from" => $stationFrom,
            "to" => $stationTo,
            "transport_types" => "suburban",
//                "transport_types" => "train", // Яндекс, спаси и сохрани
            "event" => "arrival",
            "directions" => "all"
        ];

        $result = $api->call('search', $params);
        $new_res = [];
        foreach ($result['threads'] as $key => $value) {
            $new_res[$key] = [
                'uid' => $value['thread']['uid'],
                'type' => $value['thread']['transport_type'],
                'arrival' => $value['arrival'],
                'departure' => $value['departure'],
                'stops' => $value['stops']
            ];
        }

        return $new_res;
    }

    /**
     * Функция проверки существования параметра
     *
     * @param string &$param параметр для проверки
     * @return значение параметра или null в случае его отсутствия
     */
    private function isParam(&$param)
    {
        if (isset($param)) {
            return $param;
        }
         return null;
    }


    /**
     * Результирующий метод класса
     *
     * @param array $params
     */
    public function run($params)
    {
        var_export($this->stationAB(
            $this->isParam($params['from']),
            $this->isParam($params['to']),
            $this->isParam($params['date'])
        ));
    }
}
