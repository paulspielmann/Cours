let onglets = document.querySelectorAll("#onglets-menu>li");

for (let i = 0; i < onglets.length; i++) {
    let idx = i;
    onglets[i].addEventListener("mousedown", function() {
	document.querySelector(".menu-actif").className = "";
	this.className = "menu-actif";

	divs = document.querySelectorAll("#onglets-contenu>div");
	document.querySelector(".contenu-actif").className = "";
	divs[idx].className = "contenu-actif";
    });
}
