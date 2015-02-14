markov-php
==========

experiments with markov chain in php


##Usage

Just clone and run `composer install` to create the autoloader. Not necessary if you just want to use the CLI script.

##Demos

###Word Chain

CLI:
        
        $ php chainer.php -r demos/resources/mobydick.txt

example output:
> to cast anchor in the deep; for heavy chains are being dragged along the cycloid, my soapstone for example, will


Script:

        <?php
             
        require_once(__DIR__ . '/../vendor/autoload.php');
        
        $sample = file_get_contents(__DIR__ . '/resources/nietzsche.txt');
        
        $chain = new MarkovPHP\WordChain($sample, 2);
        $sentence = $chain->generate(10);
        
        echo "YOUR PIECE OF WISDOM FROM NIETZSCHE<br><br>";
        echo $sentence;
        
example output:
> must be contrary to their pride, and also more mysterious, than one thinks: the capable man in the purity of his character

###Word Chain - Theme

CLI:
        
        $ php chainer.php -r demos/resources/mobydick.txt -t love
     
example output:
> love of neatness in seamen; some of whom would not have that ferule and buckle-screw; I'll be ready for them

        <?php
        require_once(__DIR__ . '/../vendor/autoload.php');
        
        $sample = file_get_contents(__DIR__ . '/resources/nietzsche.txt');
        
        $chain = new MarkovPHP\WordChain($sample, 2);
        $theme = "hate";
        $sentence = $chain->generate(10, $theme);
        
        echo "YOUR PIECE OF WISDOM FROM NIETZSCHE, ABOUT: $theme<br><br>";
        echo $sentence;

example output:
> they hate thee, and me, and half-and-half, and impure!-- Ah, I cast hail-showers into the depths. Violently will my breast then heave;

###Mixed Source

Combines two different sources and creates a simple chain with two connected parts:

        <?php
        require_once(__DIR__ . '/../vendor/autoload.php');
        
        $sample1 = file_get_contents(__DIR__ . '/resources/nietzsche.txt');
        $sample2 = file_get_contents(__DIR__ . '/resources/mobydick.txt');
        
        $chain = new \MarkovPHP\MixedSourceChain($sample1, $sample2);
        $sentence = $chain->generate();
        
        echo "RESULT:<br>";
        echo $sentence;
        
example output:
> do so, proves that he is probably not only strong, she keeps so many moody secrets. The schools composing none

