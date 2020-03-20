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
            if(this.readyState === XMLHttpRequest.DONE && this.status === 200){
                let resultat = JSON.parse(this.responseText);

                for(classe in resultat){
                    tableauResultat.innerHTML = teteTableau + '<tr><td>' + resultat[classe]['nom_classe'] + '</td><td>' + resultat[classe][2] + '</td><td class = "text-center"><a href="implanterProf.php?idProf=' + document.location.href.split("=")[1].toString() +'&idClasse=' + resultat[classe]["id_classe"] + '" class = "btn btn-primary">Choisir cette classe</a></td></tr>'
                }
            }
        };
        let data = {nomClasse : champs[0].value, niveauClasse : champs[1].value};
        request.open("POST",'http://localhost/DiscordChat/getClasses.php');
        request.setRequestHeader('Content-Type','application/json');
        request.send(JSON.stringify(data));
    }else{
        errors.forEach(function(error){
            let popup = '#'+error[0]+'Vide';
            document.querySelector(popup).classList.remove('hidden');
        })
    }
})