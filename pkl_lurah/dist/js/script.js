const ranmor_input = document.querySelector('.ranmor');
const pemilik_input = document.querySelector('.pemilik');
const balik_input = document.querySelector('.balik');

var ctx = document.getElementById("PieChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Pizza','Steak','Burger'],
        datasets: [
            {
                label: '# of Votes',
                data: [ 10, 10, 10],
                backgroundColor: ['#4572E', '#17BEBB', '#FFC914'],
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
});

const updateChartValue = (input, dataOrder) => {
    input.addEventListener('change', e => {
        myChart.data.datasets[0].data[dataOrder] = e.target.value;
        myChart.update();
    });
};

updateChartValue(ranmor_input, 0);
updateChartValue(balik_input, 1);
updateChartValue(pemilik_input, 2);