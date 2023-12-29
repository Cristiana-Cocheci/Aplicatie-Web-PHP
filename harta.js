var lightblue= "rgb(184,241,241)";
var lightpurple= "rgb(211,172,212)";
var pink="rgb(236, 158, 180)";
var red= "rgb(218, 88, 125)";

window.onload = function() {
    var harta= document.getElementById("harta");
    var ha = document.createElement("canvas");
    h = harta.offsetHeight;//-0.05*harta.clientHeight;
    w = harta.offsetWidth;//-0.05*harta.clientWidth;
    ha.setAttribute('id','canvmap');
    ha.setAttribute('width',h+'px');
    ha.setAttribute('height',w+'px');
    harta.appendChild(ha);
    //door.addEventListener("click",onclick);
    draw(h,w);
 }  

 function draw(h,w) {
    // desenăm ușa roșie
    const canvas = document.getElementById("canvmap");
       if (canvas.getContext) {
          const ctx = canvas.getContext("2d");
          //cadrul usii
          ctx.fillStyle = lightblue;
          ctx.fillRect(0, 0, h, w);
        
          ctx.fill();
       }
 }   