let userClass = document.location.href.split('=')[2];
let chatRoom = document.location.href.split('=')[3]
let finClassNumber = userClass.indexOf('&');
function getMessages() {
    //Recevoir les messages
    const xhr = new XMLHttpRequest();
    userClass = (userClass.slice(0,finClassNumber));
    xhr.open("POST", 'index.php?action=getMessages&class=' + userClass +'&room=' +  chatRoom);
    xhr.onload = function() {
        const result = JSON.parse(this.responseText);
        const html = result.reverse().map(function (message) {
            return `
            <div class="mt-3 mb-1 contenuMessage">
                <p><strong> ${message.nom} - ${message.prenom}</strong></p>
                <p>${message.message}</p>
            </div>
            `
        }).join('');

        const contenuMessages = document.getElementById('contenuMessages');
        contenuMessages.innerHTML = html;
        contenuMessages.scrollTop = contenuMessages.scrollHeight // Permet de voir directement les messages en bas (les derniers messages)
    };
    xhr.send();

//    Regarder utilisateurs en train d'écrire
    const req = new XMLHttpRequest();
    req.open('POST', 'index.php?action=getWritingStatus');
    req.onreadystatechange = function(){
        if(this.status === 200 && this.readyState === XMLHttpRequest.DONE){
            let response = (JSON.parse(this.responseText));
            if(response.isWriting === '1'){
                messageEnCours.classList.remove('hidden')
            }else{
                messageEnCours.classList.add('hidden')
            }
        }
    };
    let teacher = {id : messageEnCours.dataset.id};
    req.send(JSON.stringify(teacher))
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
        messageEnCours.classList.add('hidden')
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
const messageEnCours = document.querySelector('.messageEnCours');

getMessages();

function estEnTrainDEcrire() {
    const xhr = new XMLHttpRequest();
    if (this.value == "" || this.value == null) {
        xhr.open('GET','index.php?action=notWriting');
        xhr.send();
    } else {
        xhr.open('GET','index.php?action=writing');
        xhr.send();
    }
}

inputMessage.addEventListener('input', estEnTrainDEcrire)

