if (document.readyState == 'loading') {
    // ещё загружается, ждём события
    document.addEventListener('DOMContentLoaded', work);
} else {
    // DOM готов!
    work();
}


function work() {
    let range = document.getElementById('range');
    range.addEventListener('input', start);
    let p = document.createElement('p');
    let square = document.getElementById('square');
    function start(){
        p.innerHTML = this.value;
        document.body.appendChild(p);
        console.log(square.cssText);
        // let ma = parseFloat(square.style.width.split('px')[0]) + + parseInt;
        square.style = "width: " + (this.value * 1) + square.style.width;

        // square.style = "width: 300px; height: 200px";
        // console.log(this.value);

    }
}

















