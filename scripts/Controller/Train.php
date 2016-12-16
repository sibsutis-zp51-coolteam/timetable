<?php

namespace Controller;


/**
 * K/lacc co cnucKom cTaHu,uu' c/legoBaHu9|
 */
class Train
{
    public function Listing ()
    {

        $api = new \Yandex\Api();

        $params = [

            "uid" => "6630_0_9610642_g17_4",
            "transport_types" => "suburban",
            "event" => "arrival",
            "lang" => "ru",

        ];

        $info = $api->call('thread', $params);

        $result = [];
        foreach ($info["stops"] as $station){

            print_r ($station);
            $result[] = [
                "arrival" => $station ['arrival'],
                "departure" => $station ['departure'],
                "code" => $station ['station']['code'],
                "title" => $station ['station']['title']
            ];

        }

        return $result;

    }

    public function run ()
    {
        var_export ($this -> Listing());
    }
}
