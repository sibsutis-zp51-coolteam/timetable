<?php

namespace Controller;

class Json
{
    public function ab($from, $to, $date)
    {
        $controller = new StationAB();
        $result = $controller->stationAB($from, $to, $date);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function a($station, $date)
    {
        $controller = new StationTimetable();
        $result = $controller->stationTimetable($station, $date);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function train($uid, $date)
    {
        $controller = new Train();
        $result = $controller->listing($uid);

        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    private function isParam(&$value, $default = null)
    {
        if (!isset($value)) {
            return $default;
        }

        return $value;
    }

    public function run($params)
    {
        $params['type'] = $this->isParam($params['type'], 'default');

        if ($params['type'] == 'ab') {
            return $this->ab(
                $this->isParam($params['from']),
                $this->isParam($params['to']),
                $this->isParam($params['date'])
            );
        } elseif ($params['type'] == 'one') {
            return $this->a(
                $this->isParam($params['from']),
                $this->isParam($params['date'])
            );
        }

        throw new \Exception('Неизвестный тип данных');
    }
}
