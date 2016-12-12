<?php
require 'bootstrap.php';

$var = new Hello();

$var->TypeHello();
echo "\n";
$var2 = new Json\Parser();
$path = file_get_contents(__DIR__."/Json/source.js");
$var2->JsonToPhpParser($path);
