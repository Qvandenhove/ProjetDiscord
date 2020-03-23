let userClass = document.location.href.split('=')[2];
let chatRoom = document.location.href.split('=')[3]
let finClassNumber = userClass.indexOf('&');
function getMessages() {
    const xhr = new XMLHttpRequest();
    userClass = (userClass.slice(0,finClassNumber));
    xhr.open("POST", 'index.php?action=getMessages&class=' + userClass +'&room=' +  chatRoom);
    xhr.onload = function() {
        const result = JSON.parse(this.responseText);
        const html = result.reverse().map(function (message) {
            return `
            <div class="contenuMessage">
                <p><strong> ${message.nom} - ${message.prenom}</strong></p>
                <p>${message.message}</p>
            </div>
            `
        }).join('');

        const contenuMessages = document.getElementById('contenuMessages');

        contenuMessages.innerHTML = html;
        contenuMessages.scrollTop = contenuMessages.scrollHeight // Permet de voir directement les messages en bas (les derniers messages)
    }

    xhr.send()
}

function postMessage(e) {
    e.preventDefault();

    const message = document.querySelector('textarea');

    const data = new FormData;

    data.append('message', message.value);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=postMessage&class=' + userClass +'&room=' +  chatRoom);

    xhr.onload = function () {
        message.value = '';
        message.focus();
        getMessages()
    };

    xhr.send(data)
}

document.querySelector('form').addEventListener('submit', postMessage);

const interval = setInterval(getMessages, 1000); // Permet de rafraichir la page tous les x temps

getMessages();