<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chatbot I.A - BotMan</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">
        <link href="css/chatbot.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="logo">
                    <img src="https://media.giphy.com/media/1pqlCWXnNzgdXS9qon/giphy.gif" alt="Chatbot icon">
                </div>
            </div>
        </div>

        <script>
            var botmanWidget = {
                frameEndpoint: '/botman/chat',
                title: 'Chatbot - Smart TV Troubleshooting',
                introMessage: 'Hola, soy tu Chatbot y estoy acá para ayudarte con tu Smart TV. Para más informacion escribe <b>cualquier palabra</b>. Hecho por Juan Rosario (19-0723)',
                mainColor: '#F69E28',
                bubbleBackground: '#252C35'
            };
        </script>

        <!-- <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script> -->
        <!-- <script src="<?php echo e(asset('js/widget.js')); ?>"></script> -->
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous">
        </script>

        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
        <script src="<?php echo e('js/chatbot.js'); ?>"></script>
    </body>
</html>