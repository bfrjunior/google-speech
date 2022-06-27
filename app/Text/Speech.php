<?php

namespace App\Text;

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

class Speech
{
    /*
    *Método responsável por obter um cliente autenticado.
    @return TextToSpeechClient
    */
    public static function getClient()
    {
        return new TextToSpeechClient(['credentials' => __DIR__ . '/../../chave.json']);
    }


    public static function run($text, $language, $file)
    {
        //OBTÉM O CLIENTE AUTENTICADO
        $obClient = self::getClient();

        //TEXTO A SER SINTETIZADO
        $input = new SynthesisInput();
        $input->setText($text);

        //SELEÇÃO DO IDIOMA
        $voice = new VoiceSelectionParams();
        $voice->setLanguageCode($language);

        //ENCODE AUDIO - MP3
        $audioConfig = new AudioConfig();
        $audioConfig->setAudioEncoding(AudioEncoding::MP3);

        //EXECUTA A API DO GOOGLE
        $resp = $obClient->synthesizeSpeech($input, $voice, $audioConfig);

        //ESCREVE O ARQUIVO NO DISCO
        file_put_contents($file, $resp->getAudioContent());

        //SUCESSO
        return true;
    }
}
