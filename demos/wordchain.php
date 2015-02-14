<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$sample = file_get_contents(__DIR__ . '/resources/nietzsche.txt');

$chain = new MarkovPHP\WordChain($sample, 2);
$sentence = $chain->generate(10);

echo "YOUR PIECE OF WISDOM FROM NIETZSCHE<br><br>";
echo $sentence;
