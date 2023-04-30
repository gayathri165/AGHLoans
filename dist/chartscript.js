var opts = {
  lines: 12, // The number of lines to draw
  angle: 0.00, // The length of each line
  lineWidth: 0.44, // The line thickness
  
 
  pointer: {
    length: 0.5, // The radius of the inner circle
    strokeWidth: 0.035, // The rotation offset
    color: 'red' // Fill color
  },
  
  limitMax: false,   // If true, the pointer will not go past the end of the gauge
  colorStart: 'blue',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',   // to see which ones work best for you
  generateGradient: true
};
var target = document.getElementById('foo'); // your canvas element
var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
gauge.maxValue = 200; // set max gauge value
gauge.animationSpeed = 32; // set animation speed (32 is default value)

function chamar(valor){
  valor=document.getElementById("campo").value;
  gauge.set(valor); // set actual value
}