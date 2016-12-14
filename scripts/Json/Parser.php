<?php

namespace Json;

/**
 * Класс, занимающийся парсингом JSON
 */
class Parser
{
    /**
     * Метод выводит в stdout массив, преобразованный из JSON-строки
     *
     * @param string $str входящие данные в формате JSON
     */
    public function JsonToPhpParser($str)
    {
        var_dump(json_decode($str, true));
    }
}
