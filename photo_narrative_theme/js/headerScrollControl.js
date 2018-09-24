/*!
  * headerScrollControl
  */

var y_past = 0;

window.addEventListener("scroll", () => {
    const header = document.getElementById("headerBar");
    const y = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    console.log('TCL: y', y);

    if(!header) {
        return;
    }

    if(y < y_past) {
        console.log("scrolled up, should show the header");
        header.classList.add('show');
    }
    else if(y >= 160 && header.classList.contains('show')) {
        console.log("scrolled down and currently showing the header -> should hide header");
        header.classList.remove('show');
    }

    y_past = y;

}, false);