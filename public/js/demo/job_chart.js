
// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Sample `graduateData` provided by backend; replace with actual data

// Extract labels and data from `graduateData`
var labels = Object.keys(jobGraduateData);
var data = Object.values(jobGraduateData);

var ctx = document.getElementById("myJobAreaChart").getContext("2d");
var myLineChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: labels, // Graduation years
        datasets: [
            {
                label: "نسبة الخريجين العاملين",
                data: data, // Percentage data
                borderColor: "rgba(78, 115, 223, 1)",
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                fill: true,
                tension: 0.3,
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
            },
        ],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0,
            },
        },
        scales: {
            x: {
                grid: {
                    display: false,
                    drawBorder: false,
                },
                ticks: {
                    maxTicksLimit: 7,
                },
            },
            y: {
                ticks: {
                    maxTicksLimit: 10, // Set more ticks for better visualization
                    stepSize: 10, // Step size of 10%
                    max: 100, // Maximum value on the y-axis
                    padding: 10,
                    callback: function (value) {
                        return value + "%"; // Append '%' to the y-axis labels
                    },
                },
                grid: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2],
                },
            },
        },
        plugins: {
            tooltip: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: "#6e707e",
                titleFontSize: 14,
                borderColor: "#dddfeb",
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: "index",
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem) {
                        return (
                            tooltipItem.dataset.label +
                            ": " +
                            tooltipItem.raw.toFixed(2) + // Display the percentage with two decimal points
                            "%"
                        );
                    },
                },
            },
        },
        locale: "ar-YE",
    },
});
