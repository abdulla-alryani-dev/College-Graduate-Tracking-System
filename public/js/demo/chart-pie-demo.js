// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["IT", "CS", "IS"], // Dynamic labels
        datasets: [
            {
                data: [5506, 2877, 999], // Dynamic data values
                backgroundColor: generateGradientFills(3),
                hoverBackgroundColor: generateHoverGradientColors(generateGradientFills(3)),
                hoverBorderColor: "rgba(234, 236, 244, 1)"
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                // Modify the tooltip to show percentages
                label: function(tooltipItem, data) {
                    const dataset = data.datasets[tooltipItem.datasetIndex];
                    const currentValue = dataset.data[tooltipItem.index];
                    const total = dataset.data.reduce((a, b) => a + b, 0);
                    const percentage = ((currentValue / total) * 100).toFixed(2) + "%";
                    return `${data.labels[tooltipItem.index]}:  (${percentage})`;
                }
            }
        },
        legend: {
            display: false
        },
        cutoutPercentage: 80,
        plugins: {
            datalabels: {
                display: true,
                formatter: function(value, context) {
                    const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                    const percentage = ((value / total) * 100).toFixed(2) + "%";
                    return `${percentage}`;
                },
                color: "white",
                font: {
                    weight: "bold"
                }
            }
        }
    }
});

// Update Pie Chart Data Dynamically
function updatePieChartData(newData, newLabels) {
    const dynamicBackgroundColors = generateGradientFills(newLabels.length);
    const dynamicHoverBackgroundColors = generateHoverGradientColors(dynamicBackgroundColors);

    myPieChart.data.labels = newLabels;
    myPieChart.data.datasets[0].data = newData;
    myPieChart.data.datasets[0].backgroundColor = dynamicBackgroundColors;
    myPieChart.data.datasets[0].hoverBackgroundColor = dynamicHoverBackgroundColors;
    myPieChart.update();
}

// Generate Gradient Colors for Chart Sections
function generateGradientFills(count) {
    const ctx = document.getElementById("myPieChart").getContext("2d");
    const gradients = [];

    for (let i = 0; i < count; i++) {
        const gradient = ctx.createLinearGradient(0, 0, 500, 500);
        const startColor = majorColors[i]; // Generate random colors
        const endColor = majorColors[i];

        gradient.addColorStop(0, startColor);
        gradient.addColorStop(1, endColor);

        gradients.push(gradient);
    }

    return gradients;
}

// Generate Hover Colors for Chart Sections
function generateHoverGradientColors(gradients) {
    return gradients.map(gradient => gradient);
}

// Generate Random RGB Colors
function randomRGB() {
    return `rgb(${Math.floor(Math.random() * 255)}, ${Math.floor(
        Math.random() * 255
    )}, ${Math.floor(Math.random() * 255)})`;
}
