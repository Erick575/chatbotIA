window.chatBotManager = (function(){
    return {
        setup(){
            this.listenForRequests();
        },

        listenForRequests(){
            var origOpen = XMLHttpRequest.prototype.open;
            XMLHttpRequest.prototype.open = function() {
                this.addEventListener('load', function() {
                    let response = JSON.parse(this.responseText)
                    chatBotManager.onComplete(response);
                });
                origOpen.apply(this, arguments);
            };
            
        },

        onComplete(response){
            if(response.messages[0].additionalParameters.passwordRequired === true){
                let bc = new BroadcastChannel('chatbot');
                bc.postMessage("passwordRequired");
                
            }
        },
    }
}());
chatBotManager.setup();