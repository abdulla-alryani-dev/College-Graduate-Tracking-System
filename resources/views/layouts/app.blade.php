@php
    $messages = ['l'];
    $brand = '';
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | نظام متابعة الخريجين</title>

    <!-- Bootstrap 5 RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-rtl@5.3.0/dist/css/bootstrap-rtl.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* Card enhancements */
        .card {
            border: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        /* Border utilities */
        .border-end-3 {
            border-right-width: 3px !important;
        }

        /* Icon shapes */
        .icon-shape {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
        }

        .icon-shape.icon-lg {
            width: 56px;
            height: 56px;
            font-size: 1.5rem;
        }

        /* Color utilities */
        .bg-primary-light {
            background-color: rgba(67, 97, 238, 0.1);
        }

        .bg-danger-light {
            background-color: rgba(231, 74, 59, 0.1);
        }

        .bg-success-light {
            background-color: rgba(56, 161, 105, 0.1);
        }

        .bg-warning-light {
            background-color: rgba(245, 159, 0, 0.1);
        }

        /* Badge dot */
        .badge-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        /* Button enhancements */
        .btn-outline-primary {
            border-color: #4361ee;
            color: #4361ee;
        }

        .btn-outline-primary:hover {
            background-color: #4361ee;
            color: white;
        }

        /* Dropdown enhancements */
        .dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
        }

        .dropdown-item:active {
            background-color: #f8f9fa;
            color: #212529;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .icon-shape.icon-lg {
                width: 48px;
                height: 48px;
                font-size: 1.25rem;
            }

            .card-footer .text-xs {
                font-size: 0.7rem;
            }

            #refreshData span {
                display: none;
            }
        }
    </style>
    <style>
        /*body {*/
        /*    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;*/
        /*}*/
        .c-chart-wrapper {
            position: relative;
            height: 300px;
        }
    </style>
    <style>
        .badge-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-left: 5px;
        }

        .text-xs {
            font-size: 0.75rem;
        }
    </style>
    <style>
        /* Custom styles to match admin dashboard */
        .bg-primary-light {
            background-color: rgba(67, 97, 238, 0.1);
        }

        .text-primary {
            color: #4361ee !important;
        }

        .btn-close-skill {
            font-size: 0.5rem;
            padding: 0.25rem;
            line-height: 1;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .modal-header {
            border-bottom: none;
        }

        .skills-container {
            background-color: #f8f9fa;
        }
    </style>

    <style>
        /* Custom styles to match admin dashboard */
        .bg-primary-light {
            background-color: rgba(67, 97, 238, 0.1);
        }

        .text-primary {
            color: #4361ee !important;
        }

        .btn-close-skill,
        .btn-close-graduate {
            font-size: 0.5rem;
            padding: 0.25rem;
            line-height: 1;
        }

        .skills-container,
        .selected-graduates-container {
            background-color: #f8f9fa;
        }

        .modal-header {
            border-bottom: none;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
    </style>
    <style>
        .topbar .navbar-search {
            width: 25rem;
        }

        .topbar .navbar-search input {
            font-size: 0.85rem;
            height: auto;
        }
    </style>

    @yield('style')
    @stack('styles')
</head>

<body>


    <x-layouts.sidebar :user='Auth::user()' />

    <div id="content-wrapper">
        <x-layouts.topbar :messages="$messages" :brand="$brand" />
        @yield('content')
    </div>


    <!-- Bootstrap 5 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Custom JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Add this right before your custom script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate fake data
            const currentYear = new Date().getFullYear();
            const years = Array.from({
                length: 5
            }, (_, i) => currentYear - 4 + i);
            const graduatesData = years.map(() => Math.floor(Math.random() * 500) + 300);
            const registeredData = graduatesData.map(val => Math.floor(val * 0.7 + Math.random() * 50));


            const months = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'];
            const employmentData = months.map(() => Math.floor(Math.random() * 100) + 50);


            // 2. Majors Pie Chart
            // Majors Pie Chart with dynamic data from UniversityData
            const majorsCtx = document.getElementById('majorsChart');
            if (majorsCtx) {
                // Fetch majors data from Laravel backend
                fetch('/charts/majors')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Create the chart
                        const majorsChart = new Chart(majorsCtx, {
                            type: 'doughnut',
                            data: {
                                labels: data.labels,
                                datasets: [{
                                    data: data.data,
                                    backgroundColor: data.colors,
                                    borderWidth: 0
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                cutout: '70%',
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        rtl: true,
                                        titleAlign: 'right',
                                        bodyAlign: 'right',
                                        footerAlign: 'right',
                                        callbacks: {
                                            label: function(context) {
                                                const label = context.label || '';
                                                const percentage = context.raw || 0;
                                                const value = Math.round((percentage / 100) * data
                                                    .total);
                                                return `${label}: ${value} طالب (${percentage}%)`;
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        // Create legend
                        const legendContainer = document.getElementById('majorsLegend');
                        if (legendContainer) {
                            legendContainer.innerHTML = data.labels.map((major, index) => `
                    <div class="col">
                        <div class="d-flex align-items-center">
                            <span class="badge-dot me-2" style="background-color: ${data.colors[index]}"></span>
                            <span class="text-xs text-truncate" title="${major}">
                                ${major} (${data.data[index]}%)
                            </span>
                        </div>
                    </div>
                `).join('');
                        }

                        // Export button handler
                        document.getElementById('exportPieChart')?.addEventListener('click', function(e) {
                            e.preventDefault();
                            window.location.href = "{{ route('charts.majors.export') }}";
                        });

                        // Expand button handler
                        document.getElementById('expandPieChart')?.addEventListener('click', function(e) {
                            e.preventDefault();
                            // Toggle fullscreen view
                            const chartContainer = majorsCtx.closest('.card');
                            if (chartContainer) {
                                if (!document.fullscreenElement) {
                                    chartContainer.requestFullscreen().catch(err => {
                                        alert(`خطأ في فتح وضع ملء الشاشة: ${err.message}`);
                                    });
                                } else {
                                    document.exitFullscreen();
                                }
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error loading majors data:', error);
                        // Fallback to empty state
                        const legendContainer = document.getElementById('majorsLegend');
                        if (legendContainer) {
                            legendContainer.innerHTML = `
                    <div class="col-12 text-center text-muted py-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        تعذر تحميل بيانات التخصصات
                    </div>
                `;
                        }
                    });
            }

            // 3. Employment Chart (Bar Chart)
            const employmentCtx = document.getElementById('employmentChart');
            let employmentChart = null;

            // Fetch data from API endpoint
            fetch('/employment-stats')
                .then(response => response.json())
                .then(data => {
                    // Destroy existing chart if exists
                    if (employmentChart) {
                        employmentChart.destroy();
                    }

                    // Initialize new chart
                    employmentChart = new Chart(employmentCtx, {
                        type: 'bar',
                        data: {
                            labels: data.years,
                            datasets: [{
                                label: 'الخريجين الموظفين',
                                data: data.counts,
                                backgroundColor: 'rgba(67, 97, 238, 0.7)',
                                borderRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    rtl: true,
                                    callbacks: {
                                        title: (context) => 'السنة: ' + context[0].label,
                                        label: (context) => 'العدد: ' + context.parsed.y
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'السنة'
                                    },
                                    grid: {
                                        display: false
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'عدد الخريجين الموظفين'
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    },
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching employment data:', error);
                    // You can show an error message to the user here
                });

            // Rest of your existing JavaScript code...
        });
    </script>
   <script>
    document.addEventListener('DOMContentLoaded', function () {
        let mainChart;

        // Function to fetch and render chart data
        function fetchChartData(year) {
            fetch(`/chart-data?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Fetched Data:', data); // Debugging: Log the fetched data
                    if (mainChart) {
                        mainChart.destroy(); // Destroy existing chart
                    }
                    const ctx = document.getElementById('main-chart').getContext('2d');
                    mainChart = new Chart(ctx, {
                        type: 'line',
                        data: data,
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
                })
                .catch(error => {
                    console.error('Error fetching chart data:', error);
                });
        }

        // Fetch distinct years from the backend
        fetch('/years')
            .then(response => response.json())
            .then(years => {
                const yearDropdownMenu = document.getElementById('yearDropdownMenu');
                years.forEach(year => {
                    const listItem = document.createElement('li');
                    const link = document.createElement('a');
                    link.classList.add('dropdown-item');
                    link.href = '#';
                    link.setAttribute('data-year', year);
                    link.textContent = year;
                    listItem.appendChild(link);
                    yearDropdownMenu.appendChild(listItem);
                });

                // Add event listeners to the dropdown items
                const yearDropdownItems = document.querySelectorAll('.dropdown-item[data-year]');
                yearDropdownItems.forEach(item => {
                    item.addEventListener('click', function (e) {
                        //  e.preventDefault(); // Prevent default link behavior
                        const selectedYear = this.getAttribute('data-year'); // Get the selected year
                        console.log('Selected Year:', selectedYear); // Debugging: Log the selected year
                        fetchChartData(selectedYear); // Fetch and update chart data
                    });
                });

                // Load initial chart data for the first year in the list
                if (years.length > 0) {
                    fetchChartData(years[0]);
                }
            })
            .catch(error => {
                console.error('Error fetching years:', error);
            });
    });
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch real data from the server
            fetch('/charts/technologies')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Transform the data to match your chart structure
                    const skillsData = {
                        "current": data.technologies.reduce((obj, tech, index) => {
                            obj[tech] = data.percentages[index];
                            return obj;
                        }, {})
                    };

                    const colors = data.colors;

                    let skillsChart;

                    function renderSkillsChart() {
                        const yearData = skillsData["current"];
                        const skills = Object.keys(yearData);
                        const values = Object.values(yearData);

                        const ctx = document.getElementById('technicalSkillsChart').getContext('2d');

                        if (skillsChart) {
                            skillsChart.destroy();
                        }

                        skillsChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: skills,
                                datasets: [{
                                    label: 'نسبة الطلب',
                                    data: values,
                                    backgroundColor: colors,
                                    borderColor: colors.map(c => `${c}cc`),
                                    borderWidth: 1,
                                    borderRadius: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                indexAxis: 'y', // Horizontal bars
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        rtl: true,
                                        titleAlign: 'right',
                                        bodyAlign: 'right',
                                        footerAlign: 'right',
                                        callbacks: {
                                            label: function(context) {
                                                const count = data.counts[context.dataIndex];
                                                return `${context.parsed.x}% (${count} وظيفة)`;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        beginAtZero: true,
                                        max: 100,
                                        grid: {
                                            color: 'rgba(0, 0, 0, 0.05)'
                                        },
                                        ticks: {
                                            callback: function(value) {
                                                return value + '%';
                                            }
                                        }
                                    },
                                    y: {
                                        grid: {
                                            display: false
                                        }
                                    }
                                }
                            }
                        });

                        // Update legend
                        const legendContainer = document.getElementById('skillsLegend');
                        legendContainer.innerHTML = skills.map((skill, index) => `
                    <div class="col">
                        <div class="d-flex align-items-center">
                            <span class="badge-dot me-2" style="background-color: ${colors[index]}"></span>
                            <span class="text-xs">${skill}</span>
                        </div>
                    </div>
                `).join('');
                    }

                    // Initialize the chart
                    renderSkillsChart();

                    // Remove year dropdown functionality since we're not using years
                    const yearDropdown = document.getElementById('skillsYearDropdown');
                    if (yearDropdown) {
                        yearDropdown.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error loading technologies data:', error);
                    const legendContainer = document.getElementById('skillsLegend');
                    if (legendContainer) {
                        legendContainer.innerHTML = `
                    <div class="col-12 text-center text-muted py-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        تعذر تحميل بيانات التكنولوجيا
                    </div>
                `;
                    }
                });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Skill tagging functionality
            const skillInput = document.getElementById('skillInput');
            const addSkillBtn = document.getElementById('addSkillBtn');
            const selectedSkills = document.getElementById('selectedSkills');

            addSkillBtn.addEventListener('click', function() {
                const skill = skillInput.value.trim();
                if (skill) {
                    const skillTag = document.createElement('span');
                    skillTag.className = 'badge bg-primary-light text-primary me-2 mb-2';
                    skillTag.innerHTML =
                        `${skill} <button type="button" class="btn-close btn-close-white btn-close-skill ms-1" aria-label="Remove"></button>`;
                    selectedSkills.appendChild(skillTag);
                    skillInput.value = '';

                    // Add event listener to remove button
                    skillTag.querySelector('.btn-close-skill').addEventListener('click', function() {
                        skillTag.remove();
                    });
                }
            });

            // Allow adding skills with Enter key
            skillInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addSkillBtn.click();
                }
            });

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Skill tagging functionality
            const skillInput = document.getElementById('skillInput');
            const addSkillBtn = document.getElementById('addSkillBtn');
            const selectedSkills = document.getElementById('selectedSkills');

            addSkillBtn.addEventListener('click', function() {
                const skill = skillInput.value.trim();
                if (skill) {
                    const skillTag = document.createElement('span');
                    skillTag.className = 'badge bg-primary-light text-primary me-2 mb-2';
                    skillTag.innerHTML =
                        `${skill} <button type="button" class="btn-close btn-close-white btn-close-skill ms-1" aria-label="Remove"></button>`;
                    selectedSkills.appendChild(skillTag);
                    skillInput.value = '';

                    // Add event listener to remove button
                    skillTag.querySelector('.btn-close-skill').addEventListener('click', function() {
                        skillTag.remove();
                    });
                }
            });

            // Allow adding skills with Enter key
            skillInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addSkillBtn.click();
                }
            });

            // Graduates selection functionality
            const sendToAll = document.getElementById('sendToAll');
            const sendToSelected = document.getElementById('sendToSelected');
            const selectedGraduatesContainer = document.getElementById('selectedGraduatesContainer');

            sendToSelected.addEventListener('change', function() {
                if (this.checked) {
                    selectedGraduatesContainer.style.display = 'block';
                }
            });

            sendToAll.addEventListener('change', function() {
                if (this.checked) {
                    selectedGraduatesContainer.style.display = 'none';
                }
            });

            // Confirm graduates selection
            document.getElementById('confirmGraduatesSelection').addEventListener('click', function() {
                const selectedGraduates = document.querySelectorAll('.graduate-checkbox:checked');
                const selectedGraduatesContainer = document.getElementById('selectedGraduates');
                selectedGraduatesContainer.innerHTML = '';

                selectedGraduates.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const name = row.querySelector('td:nth-child(2)').textContent.trim();
                    const major = row.querySelector('td:nth-child(3)').textContent.trim();

                    const graduateBadge = document.createElement('span');
                    graduateBadge.className = 'badge bg-primary-light text-primary me-2 mb-2';
                    graduateBadge.innerHTML =
                        `${name} (${major}) <button type="button" class="btn-close btn-close-white btn-close-graduate ms-1" aria-label="Remove"></button>`;
                    selectedGraduatesContainer.appendChild(graduateBadge);

                    // Add event listener to remove button
                    graduateBadge.querySelector('.btn-close-graduate').addEventListener('click',
                        function() {
                            graduateBadge.remove();
                        });
                });

                bootstrap.Modal.getInstance(document.getElementById('selectGraduatesModal')).hide();
            });

            // Select all graduates
            document.getElementById('selectAll').addEventListener('change', function() {
                document.querySelectorAll('.graduate-checkbox').forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
