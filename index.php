<?php ?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
<title>Amirul Amri</title>
<!--<link rel='stylesheet' href='style_skills.css'>-->
<script>
window.requestAnimFrame = (function () {
        return  window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function (callback) {
                window.setTimeout(callback, 1000 / 60);
            };
    })();

    Math.randMinMax = function(min, max, round) {
        var val = min + (Math.random() * (max - min));

        if( round ) val = Math.round( val );

        return val;
    };
    Math.TO_RAD = Math.PI/180;
    Math.getAngle = function( x1, y1, x2, y2 ) {

        var dx = x1 - x2,
            dy = y1 - y2;

        return Math.atan2(dy,dx);
    };
    Math.getDistance = function( x1, y1, x2, y2 ) {

        var     xs = x2 - x1,
            ys = y2 - y1;

        xs *= xs;
        ys *= ys;

        return Math.sqrt( xs + ys );
    };

    var     FX = {};

    (function() {

        var canvas = document.getElementById('myCanvas'),
            ctx = canvas.getContext('2d'),
            lastUpdate = new Date(),
            mouseUpdate = new Date(),
            lastMouse = [],
            width, height;

        FX.particles = [];

        setFullscreen();
        document.getElementById('button').addEventListener('mousedown', buttonEffect);

        function buttonEffect() {

            var button = document.getElementById('button'),
                height = button.offsetHeight,
                left = button.offsetLeft,
                top = button.offsetTop,
                width = button.offsetWidth,
                x, y, degree;

            for(var i=0;i<40;i=i+1) {

                if( Math.random() < 0.5 ) {

                    y = Math.randMinMax(top, top+height);

                    if( Math.random() < 0.5 ) {
                        x = left;
                        degree = Math.randMinMax(-45,45);
                    } else {
                        x = left + width;
                        degree = Math.randMinMax(135,225);
                    }

                } else {

                    x = Math.randMinMax(left, left+width);

                    if( Math.random() < 0.5 ) {
                        y = top;
                        degree = Math.randMinMax(45,135);
                    } else {
                        y = top + height;
                        degree = Math.randMinMax(-135, -45);
                    }

                }
                createParticle({
                    x: x,
                    y: y,
                    degree: degree,
                    speed: Math.randMinMax(100, 150),
                    vs: Math.randMinMax(-4,-1)
                });
            }
        }
        window.setTimeout(buttonEffect, 100);

        loop();

        window.addEventListener('resize', setFullscreen );

        function createParticle( args ) {

            var options = {
                x: width/2,
                y: height/2,
                color: 'hsla('+ Math.randMinMax(160, 290) +', 100%, 50%, '+(Math.random().toFixed(2))+')',
                degree: Math.randMinMax(0, 360),
                speed: Math.randMinMax(300, 350),
                vd: Math.randMinMax(-90,90),
                vs: Math.randMinMax(-8,-5)
            };

            for (key in args) {
              options[key] = args[key];
            }

            FX.particles.push( options );
        }

        function loop() {

            var     thisUpdate = new Date(),
                delta = (lastUpdate - thisUpdate) / 1000,
                amount = FX.particles.length,
                size = 2,
                i = 0,
                p;

            ctx.fillStyle = 'rgba(15,15,15,0.25)';
            ctx.fillRect(0,0,width,height);

            ctx.globalCompositeStyle = 'lighter';

            for(;i<amount;i=i+1) {

                p = FX.particles[ i ];

                p.degree += (p.vd * delta);
                p.speed += (p.vs);// * delta);
                if( p.speed < 0 ) continue;

                p.x += Math.cos(p.degree * Math.TO_RAD) * (p.speed * delta);
                p.y += Math.sin(p.degree * Math.TO_RAD) * (p.speed * delta);

                ctx.save();

                ctx.translate( p.x, p.y );
                ctx.rotate( p.degree * Math.TO_RAD );

                ctx.fillStyle = p.color;
                ctx.fillRect( -size, -size, size*2, size*2 );

                ctx.restore();
            }

            lastUpdate = thisUpdate;

            requestAnimFrame( loop );
        }

        function setFullscreen() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        };
    })();
</script>
<style>
body{
  height: 100%;
  width: 100%;
  margin: 0;
  background-color: black;
  font-family: Arial,Helvetica,sans-serif;
}
.header{
  text-align: center;
  width: 100%;
  background-color: transparent;
  background: transparent;
  border-color: transparent;
  line-height: 50px;
}
.header ul{
  border-width:1px 0;
  list-style:none;
  margin:0;
  padding:0;
  text-align:center;
}
.header li{
  display: inline;
}
.header ul li a{
  display:inline-block;
  padding:10px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
.header li a:hover {
  background-color: #111;
}
.content{
  max-width: 500px;
  margin: auto;
  padding: 10px;
}
.hero h1{
  font-size: 85px;
  letter-spacing: normal;
  line-height: normal;
  margin: 0;
  color: white;
  display: block;
  overflow: hidden; /* Ensures the content is not revealed until the animation */
  border-right: .15em solid orange; /* The typwriter cursor */
  white-space: nowrap; /* Keeps the content on a single line */
  margin: 0 auto; /* Gives that scrolling effect as the typing happens */
  animation:
    typing 3.5s steps(60, end),
    blink-caret .75s step-end infinite;
}
@keyframes typing {
  from { width: 0 }
  to { width: 100% }
}
@keyframes blink-caret {
  from, to { border-color: transparent }
  50% { border-color: orange; }
}
.hero h5{
  font-size: 13px;
  color: white;
  letter-spacing: normal;
  line-height: normal;
  margin: 0;
  display: block;
}
.text-flicker-in-glow {
	-webkit-animation: text-flicker-in-glow 4s linear both;
	        animation: text-flicker-in-glow 4s linear both;
}
@-webkit-keyframes text-flicker-in-glow {
  0% {
    opacity: 0;
  }
  10% {
    opacity: 0;
    text-shadow: none;
  }
  10.1% {
    opacity: 1;
    text-shadow: none;
  }
  10.2% {
    opacity: 0;
    text-shadow: none;
  }
  20% {
    opacity: 0;
    text-shadow: none;
  }
  20.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.25);
  }
  20.6% {
    opacity: 0;
    text-shadow: none;
  }
  30% {
    opacity: 0;
    text-shadow: none;
  }
  30.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  30.5% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  30.6% {
    opacity: 0;
    text-shadow: none;
  }
  45% {
    opacity: 0;
    text-shadow: none;
  }
  45.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  50% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  55% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  55.1% {
    opacity: 0;
    text-shadow: none;
  }
  57% {
    opacity: 0;
    text-shadow: none;
  }
  57.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.35);
  }
  60% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.35);
  }
  60.1% {
    opacity: 0;
    text-shadow: none;
  }
  65% {
    opacity: 0;
    text-shadow: none;
  }
  65.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.35), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  75% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.35), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  75.1% {
    opacity: 0;
    text-shadow: none;
  }
  77% {
    opacity: 0;
    text-shadow: none;
  }
  77.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.4), 0 0 110px rgba(255, 255, 255, 0.2), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  85% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.4), 0 0 110px rgba(255, 255, 255, 0.2), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  85.1% {
    opacity: 0;
    text-shadow: none;
  }
  86% {
    opacity: 0;
    text-shadow: none;
  }
  86.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.6), 0 0 60px rgba(255, 255, 255, 0.45), 0 0 110px rgba(255, 255, 255, 0.25), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  100% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.6), 0 0 60px rgba(255, 255, 255, 0.45), 0 0 110px rgba(255, 255, 255, 0.25), 0 0 100px rgba(255, 255, 255, 0.1);
  }
}
@keyframes text-flicker-in-glow {
  0% {
    opacity: 0;
  }
  10% {
    opacity: 0;
    text-shadow: none;
  }
  10.1% {
    opacity: 1;
    text-shadow: none;
  }
  10.2% {
    opacity: 0;
    text-shadow: none;
  }
  20% {
    opacity: 0;
    text-shadow: none;
  }
  20.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.25);
  }
  20.6% {
    opacity: 0;
    text-shadow: none;
  }
  30% {
    opacity: 0;
    text-shadow: none;
  }
  30.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  30.5% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  30.6% {
    opacity: 0;
    text-shadow: none;
  }
  45% {
    opacity: 0;
    text-shadow: none;
  }
  45.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  50% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  55% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.45), 0 0 60px rgba(255, 255, 255, 0.25);
  }
  55.1% {
    opacity: 0;
    text-shadow: none;
  }
  57% {
    opacity: 0;
    text-shadow: none;
  }
  57.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.35);
  }
  60% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.35);
  }
  60.1% {
    opacity: 0;
    text-shadow: none;
  }
  65% {
    opacity: 0;
    text-shadow: none;
  }
  65.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.35), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  75% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.35), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  75.1% {
    opacity: 0;
    text-shadow: none;
  }
  77% {
    opacity: 0;
    text-shadow: none;
  }
  77.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.4), 0 0 110px rgba(255, 255, 255, 0.2), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  85% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.55), 0 0 60px rgba(255, 255, 255, 0.4), 0 0 110px rgba(255, 255, 255, 0.2), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  85.1% {
    opacity: 0;
    text-shadow: none;
  }
  86% {
    opacity: 0;
    text-shadow: none;
  }
  86.1% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.6), 0 0 60px rgba(255, 255, 255, 0.45), 0 0 110px rgba(255, 255, 255, 0.25), 0 0 100px rgba(255, 255, 255, 0.1);
  }
  100% {
    opacity: 1;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.6), 0 0 60px rgba(255, 255, 255, 0.45), 0 0 110px rgba(255, 255, 255, 0.25), 0 0 100px rgba(255, 255, 255, 0.1);
  }
}
.aboutMe{
  position: absolute;
  top: 900px;
  height: 500px;
  width: 500px;
  background-color: gray;
}
.aboutMe h1{
  font-size: 65px;
  letter-spacing: normal;
  line-height: normal;
  margin: 0;
  color: white;
  display: block;
}
.aboutMe p{
  font-size: 15px;
  color: white;
  line-height: 2.5em;
  letter-spacing: normal;
}
#myCanvas {
        display: block;
    }

#button{
        font-family: "Gill Sans", "Gill Sans MT", Calibri, sans-serif;
        position: absolute;
        font-size: 15px;
        text-transform: uppercase;
        padding: 2px 10px;
        left: 50%;
        width: 150px;
        margin-left: -100px;
        border-radius: 10px;
        color: white;
        text-shadow: -1px -1px 1px rgba(0,0,0,0.8);
        border: 5px solid transparent;
        border-bottom-color: rgba(0,0,0,0.35);
        background: hsla(260, 100%, 50%, 1);
        cursor: pointer;
    outline: 0 !important;

        animation: button 1s infinite alternate;
        transition: background 0.4s, border 0.2s, margin 0.2s;
    }
    #button:hover {
        background: hsla(220, 100%, 60%, 1);
        margin-top: -1px;

        animation: none;
    }
    #button:active {
        border-bottom-width: 0;
        margin-top: 5px;
    }
    @keyframes button {
        0% {
            margin-top: 0px;
        }
        100% {
            margin-top: 6px;
        }
    }
.skills-area{
  top: 1500px;
  color: white;
  position: absolute;
}
.skills-area h2{
  font-size: 65px;
    text-align: center;
}
.skills-area li{
list-style-type: none;
margin-bottom: 40px;
height: 15px;
}
.single-skills li b{
  position: relative;
  top: -35px;
  font-size: 20px;
  color: white;
}
.line{
  position: absolute;
  background: rgba(0, 214, 70, 1);
  margin: 2px 0;
  height: 15px;
}
.one{
  width: 95%;
  -webkit-animation-name: one 2s ease-out;
  -o-animation: one 2s ease-out;
  animation: one 2s ease-out;
}
.two{
  width: 75%;
  -webkit-animation: two 3s ease-out;
  -o-animation: two 3s ease-out;
  animation: two 3s ease-out;
}
.three{
  width: 75%;
  -webkit-animation: three 4s ease-out;
  -o-animation: three 4s ease-out;
  animation: three 4s ease-out;
}
.four{
  width: 85%;
  -webkit-animation: four 5s ease-out;
  -o-animation: four 5s ease-out;
  animation: four 5s ease-out;
}
.five{
  width: 65%;
  -webkit-animation: five 6s ease-out;
  -o-animation: five 6s ease-out;
  animation: five 6s ease-out;
}
@-webkit-keyframes one{
  from{
    width: 0;
  }
    to{
      width: 95%;
    }
}
@-webkit-keyframes two{
  from{
    width: 0;
  }
    to{
      width: 75%;
    }
}
@-webkit-keyframes three{
  from{
    width: 0;
  }
    to{
      width: 75%;
    }
}
@-webkit-keyframes four{
  from{
    width: 0;
  }
    to{
      width: 85%;
    }
}
@-webkit-keyframes five{
  from{
    width: 0;
  }
    to{
      width: 65%;
    }
}
.education{
  color: white;
  top: 2000px;
  position: absolute;
}
.education h1{
  font-size: 65px;
}
.education ul {
    margin-top: 25px;
    font-size: 21px;
    text-align: center;

    -webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
       -moz-animation: fadein 2s; /* Firefox < 16 */
        -ms-animation: fadein 2s; /* Internet Explorer */
         -o-animation: fadein 2s; /* Opera < 12.1 */
            animation: fadein 2s;
}

@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Firefox < 16 */
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Safari, Chrome and Opera > 12.1 */
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Internet Explorer */
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Opera < 12.1 */
@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
</style>
</head>
<body>
  <div class='header'>
    <ul>
      <li><a href='#'>Home</a></li>
      <li><a href='#'>Professional</a></li>
      <li><a href='#'>Experience</a></li>
      <li><a href='#'>Education</a></li>
      <li><a href='#'>Contact</a></li>
    </ul>
  </div>
  <div class='content'>
    <div class='hero'>
      <h1 class='firstTyping' style='padding: 100px 0 0 0;'>I'm</h1>
      <h1 class='secondTyping' >Amirul Amri</h1>
      <h5></h5>
      <h5 class='text-flicker-in-glow'>Web Developer</h5>
  </div>
  <div class='aboutMe'>
    <h1 >About</h1>
    <h1>Me</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
      nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
      reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
      Excepteur sint occaecat cupidatat non proident,
      sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <button id='button'>Download Resume</button>
      <span class='pulse'></span>
      <canvas id='myCanvas' width='600' height='500'></canvas>
  </div>
  <div class='wrapper'>
    <div class='skills-area'>
      <h2>My Skills</h2>
      <ul class='single-skills'>
        <li><span class='line one'></span><b>HTML & CSS &nbsp; (95%)</b></li>
        <li><span class='line two'></span><b>Javascript &nbsp; (75%)</b></li>
        <li><span class='line three'></span><b>Php & MySql &nbsp; (75%)</b></li>
        <li><span class='line four'></span><b>Photoshop &nbsp; (85%)</b></li>
        <li><span class='line five'></span><b>Premiere Pro &nbsp; (65%)</b></li>
      </ul>
    </div>
  </div>
  <div class='education'>
    <h1>Education</h1>
    <ul class='uni'>
      <li>2016-2018</li>
      <li>Dip Information Technology</li>
      <li>Multimedia University</li>
    </ul>
    <ul class='high'>
      <li>2011-2015</li>
      <li>SPM</li>
      <li>SMK Bandar Easter</li>
    </ul>
  </div>
</div>
</body>
</html>
