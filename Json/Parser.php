<?php

namespace Json;

class Parser
{
    public function JsonToPhpParser($str)
    {
        var_dump(json_decode($str, true));
    }
}
