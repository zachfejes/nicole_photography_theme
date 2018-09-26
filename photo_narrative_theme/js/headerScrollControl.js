/*!
  * headerScrollControl
  */

var y_past = 0;

window.addEventListener("scroll", () => {
    const header = document.getElementById("headerBar");
    const y = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;

    if(!header) {
        return;
    }

    if(y < y_past) {
        header.classList.add('show');
    }
    else if(y >= 160 && header.classList.contains('show')) {
        header.classList.remove('show');
    }

    y_past = y;

}, false);