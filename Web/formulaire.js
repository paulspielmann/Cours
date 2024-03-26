let inputNom = document.querySelector('#nom');
let inputLogin = document.querySelector('#login');

let inputs = document.querySelectorAll("input");

for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('keyup',function(event) {
        console.log('Touche ' + inputs[i].id + ' relâchée');
        if (inputs[i].id == "nom") {
            inputLogin.value = inputs[i].value.toLowerCase().replace(/[^a-z]/g, "-");
        }
        let erreur = document.querySelector('#erreur-' + inputs[i].id);
        let id = inputs[i].id;
        let text = inputs[i].value;
        if (id == "nom" && isValidName(text) ||
            id == "mdp" && text.length > 12 ||
            id == "confirmation" && text == document.querySelector("#mdp").value) { erreur.style.opacity = 0; }
        else { erreur.style.opacity = 1; }
        })
    };


function isValidName(str) {
    if (/^[a-zA-Z' ]+$/.test(str)) return true;
    else return false;
}