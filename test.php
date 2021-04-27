<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
    <style>
        .progress {
  position: relative;
  margin: 4px;
  float: left;
  text-align: center;
}
.barOverflow {
  /* Wraps the rotating .bar */
  position: relative;
  overflow: hidden; /* Comment this line to understand the trick */
  width: 90px;
  height: 45px; /* Half circle (overflow) */
  margin-bottom: -14px; /* bring the numbers up */
}
.bar {
  position: absolute;
  top: 0;
  left: 0;
  width: 90px;
  height: 90px; /* full circle! */
  border-radius: 50%;
  box-sizing: border-box;
  border: 5px solid #eee; /* half gray, */
  border-bottom-color: #0bf; /* half azure */
  border-right-color: #0bf;
}
#container {
  margin: 20px;
  width: 200px;
  height: 100px;
}
svg {
  height: 120px;
  width: 200px;
  fill: none;
  stroke: red;
  stroke-width: 10;
  stroke-linecap: round;
  -webkit-filter: drop-shadow( -3px -2px 5px gray );
  filter: drop-shadow( -3px -2px 5px gray );
  }
    </style>
    
</head>
<body>
<div class="progress">
  <div class="barOverflow">
    <div class="bar"></div>
  </div>
  <span>50</span>%
</div>

<div class="progress">
  <div class="barOverflow">
    <div class="bar"></div>
  </div>
  <span>100</span>%
</div>

<div class="progress">
  <div class="barOverflow">
    <div class="bar"></div>
  </div>
  <span>34</span>%
</div>

<div class="progress">
  <div class="barOverflow">
    <div class="bar"></div>
  </div>
  <span>56.5</span>%
</div>
<div id="container"></div>
<script>
var bar = new ProgressBar.SemiCircle(container, {
  strokeWidth: 10,
  color: 'red',
  trailColor: '#eee',
  trailWidth: 10,
  easing: 'easeInOut',
  duration: 1400,
  svgStyle: null,
  text: {
    value: '',
    alignToBottom: false
  },
  
  // Set default step function for all animate calls
  step: (state, bar) => {
    bar.path.setAttribute('stroke', state.color);
    var value = Math.round(bar.value() * 100);
    if (value === 0) {
      bar.setText('');
    } else {
      bar.setText(value+"%");
    }

    bar.text.style.color = state.color;
  }
});
bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
bar.text.style.fontSize = '2rem';

bar.animate(0.45);  // Number from 0.0 to 1.0
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>
<link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
<div id="container"></div>
</body>
</html>