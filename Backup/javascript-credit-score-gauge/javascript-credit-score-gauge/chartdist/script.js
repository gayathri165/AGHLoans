const dataSource = {
  chart: {
    caption: "Your Credit Score",
    lowerlimit: "300",
    upperlimit:700",
    showvalue: "1",
    numbersuffix: " Points",
    theme: "fusion",
    showtooltip: "0"
  },
  colorrange: {
    color: [
      {
        minvalue: "300",
        maxvalue: "600",
        code: "#F2726F"
      },
      {
        minvalue: "600",
        maxvalue: "700",
        code: "#FFC533"
      },
      
    ]
  },
  dials: {
    dial: [
      {
        value: "650"
      }
    ]
  }
};

FusionCharts.ready(function() {
  var myChart = new FusionCharts({
    type: "angulargauge",
    renderAt: "chart-container",
    width: "100%",
    height: "100%",
    dataFormat: "json",
    dataSource
  }).render();
});