<?php

namespace Controller;

class TestController implements ControllerInterface
    {
        public function run()
        {
            $ch = curl_init();

            curl_setopt ($ch, CURLOPT_URL, "http://ngs.ru");
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec ($ch);

            curl_close($ch);

            file_put_contents("result.txt", $result);
        }
    }
