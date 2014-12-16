markov-php
==========

experiments with markov chain in php


##usage
Just clone and run `composer install` to create the autoloader. Refer to the "demo.php" file for an example.


        <?php
             
        #sample text, number of words to chain. bigger the sampler, more randomness!
        $chain = new MarkovPHP\WordChain($sample, 2);
        
        #blocks to generate (in this case, 10 x 2 words)
        $sentence = $chain->generate(10);
        
        echo "YOUR PIECE OF WISDOM FROM NIETZSCHE<br><br>";
        echo $sentence;
        
example output:

>must be contrary to their pride, and also more mysterious, than one thinks: the capable man in the purity of his character
