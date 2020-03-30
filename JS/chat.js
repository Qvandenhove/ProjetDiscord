let userClass = document.location.href.split('=')[2].split('&')[0];
let chatRoom = document.location.href.split('=')[3].split('&')[0]
let finClassNumber = userClass.indexOf('&');

let resetWriting = new XMLHttpRequest();
resetWriting.open('GET','index.php?action=notWriting&class=' + userClass + '&room=' +  chatRoom);
resetWriting.send();

function getMessages() {

    //Recevoir les messages
    const xhr = new XMLHttpRequest();
    xhr.open("POST", 'index.php?action=getMessages&class=' + userClass +'&room=' +  chatRoom);
    xhr.onload = function() {
        const result = JSON.parse(this.responseText);
        const html = result.reverse().map(function (message) {
            return `
            <div class="conteneurMessage d-flex ${message.displaySide}" style = "width: 100%">
                <div class="mt-3 mb-1 contenuMessage">
                    <p><strong> ${message.nom} - ${message.prenom}</strong></p>
                    <p>${message.message}</p>
                </div>
            </div>
            `
        }).join('');

        const contenuMessages = document.getElementById('contenuMessages');
        contenuMessages.innerHTML = html;
    };
    xhr.send();

//    Regarder utilisateurs en train d'écrire
    const req = new XMLHttpRequest();
    userClass = document.location.href.split('=')[2].split('&')[0]
    req.open('GET', 'index.php?action=getWritingStatus&room=' + chatRoom + '&class=' + userClass);
    req.onload = function(){
        let response = JSON.parse(this.responseText);
        let currentMessageshown = false;

        for (user in response) {

            if(response[user].isWriting === '1'){
                messageEnCours.forEach(function(userWriting) {
                    if (response[user].id === userWriting.dataset.id) {
                        userWriting.classList.remove('hidden')
                    }
                })
            }else{
                messageEnCours.forEach(function(userWriting) {
                    if (response[user].id === userWriting.dataset.id) {
                        userWriting.classList.add('hidden')
                    }
                })
            }
            if(response[user].currentMessage !== undefined){
                currentMessageshown = true;
                document.getElementById('currentMessage').innerText = response[user].currentMessage.currentMessage;
            }else if(!currentMessageshown){
                document.getElementById('currentMessage').innerText = ''
            }
        }
    }

    req.send()
}

function postMessage(e) {
    e.preventDefault();

    const message = document.querySelector('input[name=message]');

    const data = new FormData;

    data.append('message', message.value);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=postMessage&class=' + userClass +'&room=' +  chatRoom);

    xhr.onload = function () {
        message.value = '';
        message.focus();
        // messageEnCours.classList.add('hidden')
        getMessages()
    };

    xhr.send(data)
    let req = new XMLHttpRequest();
    req.open('GET','index.php?action=notWriting');
    req.send();
}

document.querySelector('form').addEventListener('submit', postMessage);

const interval = setInterval(getMessages, 1000); // Permet de rafraichir la page tous les x temps

const inputMessage = document.querySelector('input[name=message]');
const messageEnCours = document.querySelectorAll('.messageEnCours');

getMessages();
setTimeout(function(){
    document.getElementById('contenuMessages').scrollTop = contenuMessages.scrollHeight // Permet de voir directement les messages en bas (les derniers messages)
},1000);



inputMessage.addEventListener('input', function estEnTrainDEcrire(e) {
    const xhr = new XMLHttpRequest();
    let currentMessage = {currentMessage: this.value};
    if (this.value === "" || this.value == null) {
        xhr.open('GET','index.php?action=notWriting&class=' + userClass + '&room=' +  chatRoom);
        xhr.send();
    } else {
        xhr.open('POST','index.php?action=writing&class=' + userClass +'&room=' +  chatRoom);
        xhr.send(JSON.stringify(currentMessage));
    }
});

