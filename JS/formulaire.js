let formulaire = document.querySelector('form');
let champs = document.querySelectorAll('.form-control');
formulaire.addEventListener('submit',function(e){
    e.preventDefault();
    let errors =[];
    count = 0;
    champs.forEach(function(champ){
        if(champ.value === ''){

            errors.push([champ.name,'vide'])
        }
        count++
    });
    if(errors.length === 0){
        formulaire.submit()
    }else{
        errors.forEach(function(error){
            let popup = '#'+error[0]+'Vide';
            document.querySelector(popup).classList.remove('hidden')
        })
    }
});
if(document.location.href.split("=")[1] !== undefined && document.location.href.split("=")[1] ==='wrongLog'){
    document.querySelector('.wrongLog').classList.remove('hidden')
    champs.forEach(function(champ){
        champ.style.borderColor = 'red';
        champ.style.borderWidth = '2px';
    })
}