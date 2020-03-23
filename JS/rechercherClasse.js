let formulaire = document.querySelector('form');
let champs = document.querySelectorAll('input');
let tableauResultat = document.querySelector('#resultatRecherche');

function search(){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let tableContent = '';
        if(this.readyState === XMLHttpRequest.DONE && this.status === 200){
            let resultat = JSON.parse(this.responseText);

            for(classe in resultat){
                if(document.location.href.split("=")[1].toString() === 'myPage'){
                    tableContent += '<tr><td>' + resultat[classe]['nom_classe'] + '</td><td>' + resultat[classe][2] + '</td><td class = "text-center"><a href="index.php?action=chat&class=' +resultat[classe]['id_classe'] +'&room=general' + '" class = "btn btn-primary">Entrer en communication</a></td></tr>'
                }else{
                    tableContent += '<tr><td>' + resultat[classe]['nom_classe'] + '</td><td>' + resultat[classe][2] + '</td><td class = "text-center"><a href="index.php?action=implantTeacher&userId=' + document.location.href.split("=")[2].toString() +'&classId=' + resultat[classe]["id_classe"] + '" class = "btn btn-primary">Implanter dans cette classe</a></td></tr>'
                }

            }
            tableauResultat.innerHTML = tableContent;
        }
    };
    let data = {nomClasse : champs[0].value, niveauClasse : champs[1].value};
    request.open("POST",'http://localhost/DiscordChat/index.php?action=getClasses');
    request.setRequestHeader('Content-Type','application/json');
    request.send(JSON.stringify(data));
}

search();

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
        search()
    }else{
        errors.forEach(function(error){
            let popup = '#'+error[0]+'Vide';
            document.querySelector(popup).classList.remove('hidden');
        })
    }
});