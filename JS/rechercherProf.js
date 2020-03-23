let formulaire = document.querySelector('form');
let champs = document.querySelectorAll('input');
let tableauResultat = document.querySelector('#resultatRecherche');
let teteTableau = tableauResultat.innerHTML;
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
        document.querySelector('#nomProfesseurVide').classList.add('hidden');
        let request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            console.log(this.status);
            if(this.readyState === XMLHttpRequest.DONE && this.status === 200){
                let resultat = JSON.parse(this.responseText);
                for(professeur in resultat){
                    tableauResultat.innerHTML = teteTableau + '<tr><td>' + resultat[professeur][1] + '</td><td>' + resultat[professeur][2] + '</td><td>' + resultat[professeur][3] + '</td><td class = "text-center"><a href="index.php?action=chooseClass&idProf=' + resultat[professeur][0] + '" class = "btn btn-primary">Ajouter à une classe</a></td></tr>'
                }
            }
        };
        let data = {nom : champs[0].value};
        request.open("POST",'http://localhost/DiscordChat/index.php?action=getProfs');
        request.setRequestHeader('Content-Type','application/json');
        request.send(JSON.stringify(data));
    }else{
        errors.forEach(function(error){
            let popup = '#'+error[0]+'Vide';
            document.querySelector(popup).classList.remove('hidden');
        })
    }
});