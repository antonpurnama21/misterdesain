$(function() {
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August"],
            datasets: [{
                label: ' Sales Progress',
                data: [11, 23, 28, 39, 23, 30, 12, 43],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 99, 132, 0.5)'
                ],
                borderColor: [
                    '#fff',
                    '#fff',
                    '#fff',
                    '#fff',
                    '#fff',
                    '#fff',
                    '#fff',
                    '#fff'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        stepSize: 10,
                        fontColor: "#ececec",
                        fontSize: 14
                    },
                    gridLines: {
                        color: "#fff",
                        lineWidth: 1,
                        zeroLineColor: "#fff",
                        zeroLineWidth: 1
                    },
                    stacked: true
                }],
                xAxes: [{
                    ticks: {
                        fontColor: "#646464",
                        fontSize: 14
                    },
                    gridLines: {
                        color: "#fff",
                        lineWidth: 2
                    }
                }]
            },
            responsive: true,
            chartArea: {
                backgroundColor: '#fff'
            },
            legend: {
                display: false
            }
        }
    });
});