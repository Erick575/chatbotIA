<?php

namespace App\Conversations;


use App\User;
use App\Interfaces\CurrencyInterface;
use App\Interfaces\AccountInterface;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class LgConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */

    public function askProblem($buttons)
    {
        $question = Question::create("¿Cuál problema presenta tu Smart TV?")
        ->fallback('Lo siento, no sé como responderte')
        ->callbackId('ask_about_currency')
        ->addButtons($buttons);

        return $this->ask($question, function ( Answer $answer ) {
            if ( $answer->isInteractiveMessageReply() ) {
                    switch ($answer->getValue()) {
                        case 0:
                            $this->say('<p><strong>Problema con el WIFI</strong></p>
                            <p><strong>&nbsp;Paso 1: &ldquo;</strong>Realizar los mismo pasos anteriores hasta el punto 3&rdquo;.</p>
                            <p><strong>&nbsp;Paso 2:&nbsp;</strong>Luego ingresar a la opci&oacute;n&nbsp;<strong>&ldquo;Configuraci&oacute;n avanzada de WiFi&rdquo;</strong></p>
                            <p>Para desarrollar los pasos, sigue las instrucciones que est&aacute;n a continuaci&oacute;n y que se relacionan con el estado de red.</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <ul>
                            <li>Revise el estado de la&nbsp;conexi&oacute;n del TV, el&nbsp;punto de acceso (Router) &nbsp;</li>
                            <li>Apague y encienda en el siguiente orden: M&oacute;dem de cable, espere que le m&oacute;dem de cable restablezca. Despu&eacute;s el punto de acceso que restablezca, finalmente la TV.</li>
                            <li>Si usa la direcci&oacute;n IP est&aacute;tica, ingrese directamente.</li>
                            <li>Finalmente comun&iacute;quese con el proveedor de servicios de internet o la empresa de&nbsp;AP (Enrutador).</li>
                            ');
                            break;
                        case 1: 
                            $this->say('<p><strong>CONFIGURACI&Oacute;N DE LA RED</strong></p>
                            <p><strong>Paso 1:</strong>&nbsp;Presiona el bot&oacute;n de&nbsp;(Inicio)&nbsp;del Magic remote para acceder al men&uacute; Inicio. Anda al icono&nbsp;(configuraci&oacute;n)&nbsp;y selecci&oacute;nalo con el bot&oacute;n rueda&nbsp;(Aceptar)&nbsp;del control remoto.</p>
                            <p><strong>Paso 2:&nbsp;</strong>Anda al icono de todos los ajustes y selecci&oacute;nalo con el bot&oacute;n Rueda&nbsp;<strong>(Aceptar)&nbsp;</strong>del control remoto.</p>
                            <p><strong>Paso 3:</strong>&nbsp;Selecciona RED con conexi&oacute;n cableada (Ethernet) o&nbsp;conexi&oacute;n Wifi.</p>
                            <p><strong>Paso 4:</strong>&nbsp;El dispositivo intenta conectarse autom&aacute;ticamente a la red disponible (Primero la red cableada). Cuando selecciona Conexi&oacute;n Wi-Fi, se muestra la lista de las redes disponibles. Seleccione la red que desea usar.</p>
                            <p><strong>&nbsp;Paso 5:&nbsp;</strong>Si la conexi&oacute;n es exitosa, se muestra&nbsp;<strong>&ldquo;Conectado a internet&rdquo;.&nbsp;</strong></p>
                            <p><strong>Puede verificar el estado de conexi&oacute;n en configuraci&oacute;n avanzada de&nbsp;Wi-Fi.</strong></p>
                            ');
                            break;
                        default:
                            # code...
                            break;
                    }
                    $this->say('Para realizar otra consulta escribe <b>cualquier palabra</b> en el chat');

            } else {
                $this->run();
            }
        });

    }


    public function run()
    {
        $options = [
            ['Smart TV no se conecta a internet', 0],
            ['Smart TV configurar mi Wi-Fi', 1]
        ];

        
        foreach($options as $option)
        {
            $buttons[] = Button::create($option[0])
                               ->value($option[1]);
        }

        $this->askProblem($buttons);
    }
}