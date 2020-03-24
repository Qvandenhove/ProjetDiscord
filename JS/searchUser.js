let formulaire = document.querySelector('form');
let champs = document.querySelectorAll('input');
let tableauResultat = document.querySelector('#resultatRecherche');
function rechercher(){
    tableauResultat.innerHTML = '<thead><tr><td>test</td></tr></thead>';
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if(this.readyState === XMLHttpRequest.DONE && this.status === 200){
            let resultat = JSON.parse(this.responseText);
            console.log(resultat);
            let tableContent = ''
            for(professeur in resultat){
                tableContent += '<tr><td>' + resultat[professeur][2] + '</td><td>' + resultat[professeur][1] + '</td><td>' + resultat[professeur][3] + '</td><td class = "text-center"><a href="index.php?action=chooseClass&userId=' + resultat[professeur][0] + '" class = "btn btn-primary">Ajouter à une classe</a></td></tr>'
            }
            tableauResultat.innerHTML = tableContent;

        }
    };
    let data = {nom : champs[0].value, isTeacher : Boolean(document.querySelector('select').value)};
    request.open("POST",'index.php?action=getUsers');
    request.setRequestHeader('Content-Type','application/json');
    request.send(JSON.stringify(data));
}
rechercher();
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
        document.querySelector('#nomVide').classList.add('hidden');
        rechercher()

    }else{
        errors.forEach(function(error){
            let popup = '#'+error[0]+'Vide';
            document.querySelector(popup).classList.remove('hidden');
        })
    }
});
