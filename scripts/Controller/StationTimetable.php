<?php

namespace Controller;

/**
 * Класс с расписанием станций
 */
Class StationTimetable {
    /**
     * Класс парсит расписания поездов по станции
     *
     * @param string $station код станции
     * @param string $date дата расписания
     * @return array
     */
    public function StationTimetable ($station = null, $date = null)
    {

        if (empty($date)) {
            $date = date("Y-m-d");
        }

        if (empty($station)) {
            $station = "s9610189";
        }

        $api = new \Yandex\Api();


            $params = [
               "date" => $date,
               "station" => $station,
                "transport_types" => "suburban",
                //    "transport_types" => "train", // Яндекс, спаси и сохрани
                "event" => "arrival",
                "directions" => "all"
            ];

        $result = $api->call('schedule', $params);
        $new_res = [];
        foreach ($result['schedule'] as $key => $value) {
            if (empty($value['departure'])) {
                $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Novosibirsk'));
                $dateTime->modify($value['arrival']);
                $dateTime->modify('+1 minute');
                $timeDeparture = $dateTime->format('Y-m-d H:i:s');
            } else {
                $timeDeparture = $value['departure'];
            }
            $new_res[$key] = [
                'uid' => $value['thread']['uid'],
                'type' => $value['thread']['transport_type'],
                'arrival' => $value['arrival'],
                'departure' => $timeDeparture,
                'number' => $value['thread']['title'],
                'days' => $value['days'],
                'stops' => $value['stops']
            ];

        }

        return $new_res;

    }
    /**
     * Результирующий метод класса
     */
    public function run()
    {
        var_export ($this->StationTimetable());

    }

}
