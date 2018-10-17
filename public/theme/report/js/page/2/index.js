var canvass = document.body.querySelector('#page1'),

    ctxs = canvass.getContext('2d'),

    ws = canvass.width = window.innerWidth,

    hs = canvass.height = window.innerHeight,



    

    //parameters

    total = (ws/8)|0,

    accelleration = .05,

    lineAlpha = .02,

    range = 25,

    

    //afterinitial calculations

    size = ws/total,

    occupation = ws/total,

    repaintColor = 'rgba(0, 0, 0, .04)'

    colors = [],

    dots = [],

    dotsVel = [];



//setting the colors' hue

//and y level for all dots

var portion = 360/total;

for(var i = 0; i < total; ++i){

  colors[i] = portion * i;

  

  dots[i] = hs;

  dotsVel[i] = 10;

}



function anim(){

  window.requestAnimationFrame(anim);

  

  ctxs.fillStyle = repaintColor;

  ctxs.fillRect(0, 0, ws, hs);

  

  for(var i = 0; i < total; ++i){

    var currentY = dots[i] - 1;

    dots[i] += dotsVel[i] += accelleration;

    

    for(var j = i+1; j < i+range && j < total; ++j){

      if(Math.abs(dots[i] - dots[j]) <= range*size){

        ctxs.strokeStyle = 'hsla(hue, 80%, 50%, alp)'.replace('hue', (colors[i] + colors[j] + 360)/2 - 180).replace('alp', lineAlpha);

        ctxs.beginPath();

        ctxs.moveTo(i * occupation, dots[i]);

        ctxs.lineTo(j * occupation, dots[j]);

        ctxs.stroke();

      }

    }

    

    if(dots[i] > hs && Math.random() < .01){

      dots[i] = dotsVel[i] = 0;

    }

  }

}



anim();