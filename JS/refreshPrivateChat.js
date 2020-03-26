let request = new XMLHttpRequest();
let messageCounts;
let notifNewMessage = document.querySelectorAll('.newMessage');
listPrivateChat = [];
notifNewMessage.forEach(function(notif){
    listPrivateChat.push(notif.dataset.roomname);
    listPrivateChat.push(notif.dataset.roomnamereverse)
});
function getMessageNumber(){
    request.open('GET','index.php?action=getMessageCount');
        request.onload = function(){
            messageCounts = JSON.parse(this.responseText);

            for (countMessage in messageCounts){
                let index = 0;
                listPrivateChat.forEach(function(privateChat){
                    if(messageCounts[countMessage][0] === privateChat){
                        notifNewMessage[Math.trunc(index / 2)].dataset.messageCount = messageCounts[countMessage][1].toString();
                    }
                    index++
                })
            }
        };
    request.send();

}

getMessageNumber();

function checkMessageNumber(){
    let checkMessageCount = new XMLHttpRequest();
    checkMessageCount.open('GET','index.php?action=getMessageCount');
    checkMessageCount.onload = function(){
        messageCounts = JSON.parse(this.responseText);
        for (countMessage in messageCounts){
            let index = 0;
            listPrivateChat.forEach(function(privateChat){
                if(messageCounts[countMessage][0] === privateChat){
                    if(notifNewMessage[Math.trunc(index / 2)].dataset.messageCount !== messageCounts[countMessage][1].toString()){
                        notifNewMessage[Math.trunc(index / 2)].classList.remove('hidden');
                    }
                }
                index++
            })
        }
    }
    checkMessageCount.send();
}

setInterval(checkMessageNumber,1000 );