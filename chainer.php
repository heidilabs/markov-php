#!/usr/bin/env php
<?php

// Use autoloader if it exists, otherwise include source explicitly
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once(__DIR__ . '/vendor/autoload.php');
} else {
    require_once(__DIR__ . '/src/MarkovPHP/WordChain.php');
}

// Get cli options
$opts = getopt('hr:t:n:l:');
if (isset($opts['h']) || !isset($opts['r'])) {
    echo "Usage: {$_SERVER['PHP_SELF']} <options>\n\n" .
         "Options:\n" .
         "    -h         print this help\n" .
         "    -r <path>  set text file to read\n" .
         "    -t <theme> set theme (default: random)\n" .
         "    -n <len>   set chain length (default: 2)\n" .
         "    -l <num>   set number of chains to generate (default: 10)\n";
    exit(0);
}

// Read path
if (!is_readable($opts['r'])) {
    fwrite(STDERR, "Path not readable: {$opts['r']}\n");
    exit(1);
} else if (($text = file_get_contents($opts['r'])) === false) {
    fwrite(STDERR, "Failed to read path: {$opts['r']}\n");
    exit(1);
}

// Set chain length
$order = isset($opts['n']) ? (int)$opts['n'] : 2;
if ($order < 2) {
    fwrite(STDERR, "Order must be >= 2\n");
    exit(1);
}

// Make chainer
$chainer = new MarkovPHP\WordChain($text, $order);

// Generate text
echo $chainer->generate(
    (isset($opts['l']) ? (int)$opts['l'] : 10) - 1,
    isset($opts['t']) ? $opts['t'] : null
) . "\n";
