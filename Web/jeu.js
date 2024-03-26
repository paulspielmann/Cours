let score = 0;

document.addEventListener("keydown", function(e) {
    let tux = document.getElementById("tux");
    let rect = tux.getBoundingClientRect(); // Get current pos rectangle
    let left = rect.left, top = rect.top;
    let width = rect.width, height = rect.height;
    let moveDist = 30;
    
    switch (e.key) {
    case "ArrowDown":
	top += moveDist;
	break;
    case "ArrowUp":
	top -= moveDist;
	break;
    case "ArrowLeft":
	left -= moveDist;
	break;
    case "ArrowRight":
	left += moveDist;
	break;
    default:
	console.log(e.key);
    }

    if (left < 5 ||
        left + width > 515 ||
        top < 5 ||
        top + height > 515) return;
    
    tux.style.left = left + 'px';
    tux.style.top = top + 'px';
})

document.addEventListener('mousedown', function(e) {
    e.preventDefault();
    let x = e.pageX ,y = e.pageY;
    if (x > 494 ||
	y > 494 ||
	x < 26 ||
	y < 26) return;

    let i = document.createElement('img');
    i.src='https://moodle.iutv.univ-paris13.fr/img/bjs/splat.png';
    i.className = "splat";
    document.body.append(i);
    window.getComputedStyle(i).top;
    i.style.top = (e.pageY - 16) + 'px';
    i.style.left = (e.pageX - 16) + 'px';
    i.style.transform = "scale(1)";
    setTimeout(function() {
	let tux = document.getElementById("tux").getBoundingClientRect();
	let splat = i.getBoundingClientRect();

	/*if (splat.top + splat.height >= tux.top &&
	    splat.top < tux.top + tux.height &&
	    splat.left + splat.width >= tux.left &&
	    splat.left < tux.left + tux.width) { console.log("CA TOUCHE"); }
	else { console.log("CA TOUCHE PAS"); }*/
	
	if (tux.right < splat.right ||
	    tux.left > splat.right ||
	    tux.bottom < splat.top ||
	    tux.top > splat.bottom) {
	    score += 10; i.style.zIndex = -1;
	} else { score -= 5; i.src = "https://moodle.iutv.univ-paris13.fr/img/bjs/splat2.png"; }
	updateScore();
    }, 300)
})

function updateScore() {
    document.querySelector('#score').textContent = score;
}
