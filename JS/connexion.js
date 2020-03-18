let formulaire = document.querySelector('form');
let nomChamps = ['mail', 'mot de passe'];

let request = new XMLHttpRequest();

formulaire.addEventListener('submit',function(event){
    event.preventDefault();
    let errors = [];
    let champs = [];
    champs.push(document.getElementById("mail"));
    champs.push(document.getElementById("pass"));
    champs.forEach(function(champ){
        if (champ.value === ''){
            errors.push(champ.name+'Vide')
        }
    });
    errors.forEach(function(error){
        if (error === 'mailVide'){
            document.getElementById("erreurMail").classList.remove('hidden')
        }

        else if (error === 'passVide'){
            document.getElementById("erreurPass").classList.remove('hidden')
        }
    })

    if(errors.length === 0){
        console.log('ok');
        formulaire.submit()
    }

});

function send(url,content){

}