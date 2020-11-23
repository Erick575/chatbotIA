<?php

namespace App\Conversations;


use App\User;
use App\Interfaces\CurrencyInterface;
use App\Interfaces\AccountInterface;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class VizioConversation extends Conversation
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

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                switch ($answer->getValue()) {
                    case 0:
                        $this->say('<p><strong>No se conecta al WiFi</strong></p>
                        <h3>Paso 1</h3>
                        <p>Pulsa el bot&oacute;n "Men&uacute;" en el control remoto, selecciona "Red", selecciona "Configuraci&oacute;n manual" y luego selecciona "Probar conexi&oacute;n." Si hay un problema con la conexi&oacute;n, se te notificar&aacute; y podr&aacute;s empezar a solucionarlo.</p>
                        <h3>Paso 2</h3>
                        <p>Selecciona el nombre de la red inal&aacute;mbrica de la lista de "Puntos de Acceso Inal&aacute;mbrico" (incluso si ya lo hiciste antes) e introduce la clave de seguridad inal&aacute;mbrica para tu red. La clave se debe introducir exactamente o no se conectar&aacute;. Pulsa el bot&oacute;n "Conectar".</p>
                        <h3>Paso 3</h3>
                        <p>Inicia sesi&oacute;n en el men&uacute; de configuraci&oacute;n del router inal&aacute;mbrico (generalmente se hace escribiendo la direcci&oacute;n interna del router IP, por ejemplo, "192.168.0.1", "192.168.1.1" o "192.168.2.1" en la barra de direcciones de tu navegador Web) y desactiva la opci&oacute;n "Direcci&oacute;n de filtros MAC ".</p>
                        <div class="mobile-display-ad" data-ad-unit-name="slot" data-ad-unit-index="1">&nbsp;</div>
                        <h3>Paso 4</h3>
                        <p>Ve a la secci&oacute;n "actualizaci&oacute;n" del men&uacute; de configuraci&oacute;n del router y ve si hay nuevos controladores, software o firmware para el router. Si hay actualizaciones disponibles, sigue las instrucciones que aparecen en pantalla para instalarlas.</p>
                        <h3>Paso 5</h3>
                        <p>Vuelve a comprobar la clave de seguridad inal&aacute;mbrica en el "Configuraci&oacute;n inal&aacute;mbrica&rdquo; del men&uacute; de configuraci&oacute;n del router. La clave de seguridad se muestra en su totalidad en este men&uacute; y se puede cambiar si lo deseas.</p>
                        <h3>Paso 6</h3>
                        <p>Conecta otro dispositivo, como una computadora o un iPhone a tu red inal&aacute;mbrica. Si no puedes conectarte, pulsa el bot&oacute;n "Reiniciar" en la parte posterior de tu router para restablecer la red inal&aacute;mbrica. Una vez restablecido, los problemas de conectividad inal&aacute;mbricas deben ser resueltos tanto para tu HDTV Vizio y como para otros dispositivos. Si contin&uacute;as teniendo problemas de conectividad inal&aacute;mbrica, la red de tu router puede ser defectuosa.</p>
                        <h3>Paso 7</h3>
                        <p>Inserta un cable Ethernet firmemente tanto en la parte posterior de tu HDTV Vizio y como al puerto "LAN" en el router o m&oacute;dem y comprueba la conexi&oacute;n a tu televisi&oacute;n de nuevo. Si sigues sin poder conectarte a Internet, ponte en contacto con el fabricante del router y/o tu proveedor de servicios de Internet para obtener m&aacute;s ayuda.</p>
                        ');

                        break;
                    case 1:
                        $this->say('<p><strong>No Enciende</strong></p>
                        <ol>
                        <li>Desenchufe el cable de su televisor de la toma de corriente y d&eacute;jelo desconectado.</li>
                        <li>Localice el bot&oacute;n de encendido de su televisor. Como dijimos, normalmente lo encontrar&aacute;s en la parte inferior izquierda o derecha.</li>
                        <li>Mantenga pulsado el bot&oacute;n de su televisor durante unos 10 segundos.</li>
                        <li>Intente encender el televisor de nuevo.</li>
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
            ['Smart TV no quiere encender', 1]
        ];


        foreach ($options as $option) {
            $buttons[] = Button::create($option[0])
                ->value($option[1]);
        }

        $this->askProblem($buttons);
    }
}
