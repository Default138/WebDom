
const urlBase = 
    document.getElementById("confUrlBase").dataset.urlBase;
const url = urlBase + "/api/lista_disciplinas.php?id_curso=2";

function listarDisciplinas() {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", url, false);
    xhttp.send();

    var json = xhttp.response
    console.log(jsnon);
}