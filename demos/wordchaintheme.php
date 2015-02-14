<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$sample = file_get_contents(__DIR__ . '/resources/nietzsche.txt');

$chain = new MarkovPHP\WordChain($sample, 2);
$theme = "hate";
$sentence = $chain->generate(10, $theme);

echo "YOUR PIECE OF WISDOM FROM NIETZSCHE, ABOUT: $theme<br><br>";
echo $sentence;
