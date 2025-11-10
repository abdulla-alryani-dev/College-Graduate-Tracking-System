{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">--}}
{{--    <title>Main Chart</title>--}}
{{--    <!-- Bootstrap 4.6.2 CSS -->--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <!-- Simplebar CSS -->--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">--}}
{{--    <!-- Chart.js CSS -->--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/@coreui/chartjs@latest/dist/css/coreui-chartjs.css" rel="stylesheet">--}}
{{--    <!-- Custom CSS for thin progress lines -->--}}
{{--    <style>--}}
{{--        .progress-thin {--}}
{{--            height: 4px; /* Adjust the height to make it thinner */--}}
{{--            background-color: #e9ecef; /* Light gray background */--}}
{{--            border-radius: 2px; /* Rounded corners */--}}
{{--        }--}}
{{--        .progress-thin .progress-bar {--}}
{{--            height: 100%; /* Fill the height of the container */--}}
{{--            border-radius: 2px; /* Rounded corners */--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container">--}}

{{--<!-- /.row-->--}}
{{--<div class="card mb-4">--}}
{{--    <div class="card-body">--}}
{{--        <div class="d-flex justify-content-between">--}}
{{--            <div>--}}
{{--                <h4 class="card-title mb-0">Traffic</h4>--}}
{{--                <div class="small text-body-secondary">January - July 2023</div>--}}
{{--            </div>--}}
{{--            <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">--}}
{{--                <div class="btn-group btn-group-toggle mx-3" data-coreui-toggle="buttons">--}}
{{--                    <input class="btn-check" id="option1" type="radio" name="options" autocomplete="off">--}}
{{--                    <label class="btn btn-outline-secondary"> Day</label>--}}
{{--                    <input class="btn-check" id="option2" type="radio" name="options" autocomplete="off" checked="">--}}
{{--                    <label class="btn btn-outline-secondary active"> Month</label>--}}
{{--                    <input class="btn-check" id="option3" type="radio" name="options" autocomplete="off">--}}
{{--                    <label class="btn btn-outline-secondary"> Year</label>--}}
{{--                </div>--}}
{{--                <button class="btn btn-primary" type="button">--}}
{{--                    <svg class="icon">--}}
{{--                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-cloud-download"></use>--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">--}}
{{--            <canvas class="chart" id="main-chart" height="300"></canvas>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="card-footer">--}}
{{--        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5 g-4 mb-2 text-center">--}}
{{--            <div class="col">--}}
{{--                <div class="text-body-secondary">Visits</div>--}}
{{--                <div class="fw-semibold text-truncate">29.703 Users (40%)</div>--}}
{{--                <div class="progress progress-thin mt-2">--}}
{{--                    <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <div class="text-body-secondary">Unique</div>--}}
{{--                <div class="fw-semibold text-truncate">24.093 Users (20%)</div>--}}
{{--                <div class="progress progress-thin mt-2">--}}
{{--                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <div class="text-body-secondary">Pageviews</div>--}}
{{--                <div class="fw-semibold text-truncate">78.706 Views (60%)</div>--}}
{{--                <div class="progress progress-thin mt-2">--}}
{{--                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col">--}}
{{--                <div class="text-body-secondary">New Users</div>--}}
{{--                <div class="fw-semibold text-truncate">22.123 Users (80%)</div>--}}
{{--                <div class="progress progress-thin mt-2">--}}
{{--                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col d-none d-xl-block">--}}
{{--                <div class="text-body-secondary">Bounce Rate</div>--}}
{{--                <div class="fw-semibold text-truncate">40.15%</div>--}}
{{--                <div class="progress progress-thin mt-2">--}}
{{--                    <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- /.card-->--}}


{{--<!-- Bootstrap 4.6.2 JS and dependencies -->--}}
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>--}}
{{--<!-- Simplebar JS -->--}}
{{--<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>--}}
{{--<!-- Chart.js -->--}}
{{--<script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/chart.umd.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/@coreui/chartjs@latest/dist/js/coreui-chartjs.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/@coreui/utils@latest/dist/umd/index.js"></script>--}}

{{--<script>--}}
{{--    // Random function for generating data--}}
{{--    function random(min, max) {--}}
{{--        return Math.floor(Math.random() * (max - min + 1)) + min;--}}
{{--    }--}}

{{--    // Initialize the main chart--}}
{{--    const mainChart = new Chart(document.getElementById('main-chart'), {--}}
{{--        type: 'line',--}}
{{--        data: {--}}
{{--            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],--}}
{{--            datasets: [--}}
{{--                {--}}
{{--                    label: 'My First dataset',--}}
{{--                    backgroundColor: `rgba(51, 153, 255, 0.1)`, // Blue background--}}
{{--                    borderColor: 'rgb(51, 153, 255)', // Blue border--}}
{{--                    pointHoverBackgroundColor: '#fff',--}}
{{--                    borderWidth: 2,--}}
{{--                    data: [--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200)--}}
{{--                    ],--}}
{{--                    fill: true--}}
{{--                },--}}
{{--                {--}}
{{--                    label: 'My Second dataset',--}}
{{--                    borderColor: 'rgb(27, 158, 62)', // Green border--}}
{{--                    pointHoverBackgroundColor: '#fff',--}}
{{--                    borderWidth: 2,--}}
{{--                    data: [--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200),--}}
{{--                        random(50, 200)--}}
{{--                    ]--}}
{{--                }--}}
{{--            ]--}}
{{--        },--}}
{{--        options: {--}}
{{--            maintainAspectRatio: false,--}}
{{--            plugins: {--}}
{{--                tooltip: {--}}
{{--                    enabled: true,--}}
{{--                    mode: 'index',--}}
{{--                    intersect: false,--}}
{{--                    callbacks: {--}}
{{--                        title: function (context) {--}}
{{--                            return context[0].label; // Tooltip title--}}
{{--                        },--}}
{{--                        label: function (context) {--}}
{{--                            return `${context.dataset.label}: ${context.raw}`; // Tooltip label--}}
{{--                        }--}}
{{--                    }--}}
{{--                },--}}
{{--                legend: {--}}
{{--                    display: false--}}
{{--                }--}}
{{--            },--}}
{{--            scales: {--}}
{{--                x: {--}}
{{--                    grid: {--}}
{{--                        color: 'rgba(0, 0, 0, 0.1)',--}}
{{--                        drawOnChartArea: false--}}
{{--                    },--}}
{{--                    ticks: {--}}
{{--                        color: '#333' // Dark text color--}}
{{--                    }--}}
{{--                },--}}
{{--                y: {--}}
{{--                    border: {--}}
{{--                        color: 'rgba(0, 0, 0, 0.1)'--}}
{{--                    },--}}
{{--                    grid: {--}}
{{--                        color: 'rgba(0, 0, 0, 0.1)'--}}
{{--                    },--}}
{{--                    ticks: {--}}
{{--                        beginAtZero: true,--}}
{{--                        color: '#333', // Dark text color--}}
{{--                        max: 250,--}}
{{--                        maxTicksLimit: 5,--}}
{{--                        stepSize: Math.ceil(250 / 5)--}}
{{--                    }--}}
{{--                }--}}
{{--            },--}}
{{--            elements: {--}}
{{--                line: {--}}
{{--                    tension: 0.4--}}
{{--                },--}}
{{--                point: {--}}
{{--                    radius: 0,--}}
{{--                    hitRadius: 10,--}}
{{--                    hoverRadius: 4,--}}
{{--                    hoverBorderWidth: 3--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>College Dashboard</title>
    <!-- Bootstrap 4.6.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/chartjs@latest/dist/css/coreui-chartjs.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .card {
            margin-bottom: 20px;
        }
        .chart-container {
            height: 300px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center my-4">College Dashboard</h1>

    <!-- Graduation Status -->
    <div class="card">
        <div class="card-header">
            <h4>Graduation Status</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Employed vs. Unemployed Graduates</h5>
                    <canvas id="employmentChart" class="chart-container"></canvas>
                </div>
                <div class="col-md-6">
                    <h5>Employment Trends</h5>
                    <canvas id="employmentTrendsChart" class="chart-container"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Market Job Status -->
    <div class="card">
        <div class="card-header">
            <h4>Market Job Status</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Most Common Jobs</h5>
                    <canvas id="jobsChart" class="chart-container"></canvas>
                </div>
                <div class="col-md-6">
                    <h5>Most In-Demand Technologies</h5>
                    <canvas id="technologiesChart" class="chart-container"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recommendations -->
    <div class="card">
        <div class="card-header">
            <h4>Recommendations for Study Optimization</h4>
        </div>
        <div class="card-body">
            <ul id="recommendationsList" class="list-group">
                <!-- Recommendations will be dynamically added here -->
            </ul>
        </div>
    </div>
</div>

<!-- Bootstrap 4.6.2 JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/chart.umd.js"></script>

<script>
    // Graduation Status Data
    const employmentData = {
        labels: ['Employed', 'Unemployed'],
        datasets: [{
            data: [70, 30], // Example data
            backgroundColor: ['#36a2eb', '#ff6384']
        }]
    };

    const employmentTrendsData = {
        labels: ['2019', '2020', '2021', '2022', '2023'],
        datasets: [{
            label: 'Employment Rate',
            data: [60, 65, 70, 75, 80], // Example data
            borderColor: '#36a2eb',
            fill: false
        }]
    };

    // Market Job Status Data
    const jobsData = {
        labels: ['Software Engineer', 'Data Scientist', 'Web Developer', 'DevOps Engineer'],
        datasets: [{
            label: 'Number of Jobs',
            data: [120, 90, 80, 70], // Example data
            backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56']
        }]
    };

    const technologiesData = {
        labels: ['Python', 'JavaScript', 'Java', 'React', 'AWS'],
        datasets: [{
            label: 'Demand Level',
            data: [90, 85, 80, 75, 70], // Example data
            backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#4bc0c0']
        }]
    };

    // Initialize Charts
    new Chart(document.getElementById('employmentChart'), {
        type: 'pie',
        data: employmentData
    });

    new Chart(document.getElementById('employmentTrendsChart'), {
        type: 'line',
        data: employmentTrendsData
    });

    new Chart(document.getElementById('jobsChart'), {
        type: 'bar',
        data: jobsData
    });

    new Chart(document.getElementById('technologiesChart'), {
        type: 'bar',
        data: technologiesData
    });

    // Recommendations
    const recommendations = [
        "Add a course on React and AWS to meet market demand.",
        "Increase focus on Python and Data Science due to high demand.",
        "Partner with top employers like Company X and Company Y for internships."
    ];

    const recommendationsList = document.getElementById('recommendationsList');
    recommendations.forEach(recommendation => {
        const li = document.createElement('li');
        li.className = 'list-group-item';
        li.textContent = recommendation;
        recommendationsList.appendChild(li);
    });
</script>
</body>
</html>
