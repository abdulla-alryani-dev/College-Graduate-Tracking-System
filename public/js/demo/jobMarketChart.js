document.addEventListener('DOMContentLoaded', function () {
    const random = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;

    const mainChart = new Chart(document.getElementById('main-chart'), {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label: 'الخريجين الموظفين',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderColor: '#007bff',
                    pointHoverBackgroundColor: '#fff',
                    borderWidth: 2,
                    data: [
                        random(50, 200),
                        random(50, 200),
                        random(50, 200),
                        random(50, 200),
                        random(50, 200),
                        random(50, 200),
                        random(50, 200)
                    ],
                    fill: true
                },
                {
                    label: 'الوظائف المتاحة',
                    borderColor: '#28a745',
                    pointHoverBackgroundColor: '#fff',
                    borderWidth: 2,
                    data: [
                        random(50, 200),
                        random(50, 200),
                        random(50, 200),
                        random(50, 200),
                        random(50, 200),
                        random(50, 200),
                        random(50, 200)
                    ]
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawOnChartArea: false
                    },
                    ticks: {
                        color: '#333'
                    }
                },
                y: {
                    border: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        beginAtZero: true,
                        color: '#333',
                        max: 250,
                        maxTicksLimit: 5,
                        stepSize: Math.ceil(250 / 5)
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4,
                    hoverBorderWidth: 3
                }
            }
        }
    });
});
