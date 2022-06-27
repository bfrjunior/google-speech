<?php

/*AUTO LOAD DO COMPOSER
    @param string $text
    @param string $language
    @param string $file
    @return [type]
 */

require __DIR__ . '/vendor/autoload.php';

use \App\Text\Speech;


//EXECUTA A SINTETIZAÇÃO DO TEXTO EM VOZ
Speech::run('Fala devs, Beleza!', 'pt-br', __DIR__ . '/audio.mp3');
