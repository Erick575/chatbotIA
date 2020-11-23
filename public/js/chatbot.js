window.chatbot = (function(){
    let chatbotChannel = new BroadcastChannel('chatbot');    
    return {
        setup(){
            this.startConversation();
            this.loadScript();
            let $userInp = $("iframe").contents().find("#userText");
            chatbotChannel.onmessage = this.onMessage;
        },

        startConversation(){
            setTimeout(() => {
                // botmanChatWidget.whisper("start");
            }, 200);
        },

        loadScript(){
            $("iframe").contents().find('head').append($("<script />", {src: '/js/jquery.min.js'}));
            $("iframe").contents().find('head').append($("<script />", {src: '/js/chatbot-manager.js'}));
        },

        onMessage(e){
            if(e.data == "passwordRequired"){
                chatbot.setPasswordEnviroment();
            }
        },

        setPasswordEnviroment(){
            let $userInp = $("iframe").contents().find("#userText");
            $userInp.attr("type","password");
            $userInp.keydown(function(e){
                if(e.keyCode == 13){
                    e.preventDefault();
                    botmanChatWidget.whisper($(this).val());
                    chatbot.quitPasswordEnviroment();
                }
            });
        },

        quitPasswordEnviroment(){
            let $userInp = $("iframe").contents().find("#userText");
            $userInp.unbind("keydown");
            $userInp.attr("type","text");
            $userInp.val("");
        }
    }
}());

$(document).on('DOMNodeInserted', function(e) {
    if (e.target.localName == "iframe") {
        chatbot.setup();
        let $userInp = $("iframe").contents().find("#userText").attr('autocomplete', 'off');
    }
});