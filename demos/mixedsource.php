<?php

require_once(__DIR__ . '/../vendor/autoload.php');

$sample1 = file_get_contents(__DIR__ . '/resources/nietzsche.txt');
$sample2 = file_get_contents(__DIR__ . '/resources/mobydick.txt');

$chain = new \MarkovPHP\MixedSourceChain($sample1, $sample2);
$sentence = $chain->generate();

echo "RESULT:<br>";
echo $sentence;
