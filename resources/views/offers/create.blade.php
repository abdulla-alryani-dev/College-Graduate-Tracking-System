<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>نموذج عرض وظيفي متكامل</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Tajawal', sans-serif;
        }

        .form-container {
            max-width: 1200px;
            margin: 2rem auto;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .section-header {
            border-right: 4px solid var(--primary-color);
            padding-right: 1rem;
            margin-bottom: 2rem;
        }

        .dynamic-section {
            background-color: #f8f9fc;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            padding: 1rem;
            border: 2px dashed #dee2e6;
            border-radius: 0.75rem;
            min-height: 56px;
        }

        .skill-tag {
            background-color: #e9ecef;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
        }

        .salary-input-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: center;
        }

        .form-check-label {
            font-weight: 500;
        }

        .preview-card {
            border-left: 4px solid var(--primary-color);
            background-color: #f8f9fc;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="form-container p-4">
        <header class="mb-5 text-center">
            <h1 class="h2 text-primary fw-bold">
                <i class="fas fa-file-contract me-2"></i>نموذج إنشاء عرض وظيفي
            </h1>
            <p class="text-muted">املأ جميع الحقول المطلوبة بدقة لإنشاء العرض الوظيفي</p>
        </header>

        <form id="jobForm" action="{{route('offers.store')}}" novalidate>
            <!-- القسم الأساسي -->
            <div class="dynamic-section">
                <div class="section-header">
                    <h3 class="h4 text-primary fw-semibold">
                        <i class="fas fa-info-circle me-2"></i>المعلومات الأساسية
                    </h3>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="job_title" class="form-label fw-medium">المسمى الوظيفي <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="job_title" name="job_title" required>
                    </div>

                    <div class="col-md-6">
                        <label for="job_category" class="form-label fw-medium">التصنيف الوظيفي <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg" id="job_category" name="job_category" required>
                            <option value="">اختر التصنيف</option>
                            <option>تقنية المعلومات</option>
                            <option>التسويق الرقمي</option>
                            <option>إدارة الأعمال</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="job_type" class="form-label fw-medium">نوع الوظيفة <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg" id="job_type" name="job_type" required>
                            <option value="">اختر النوع</option>
                            <option>دوام كامل</option>
                            <option>دوام جزئي</option>
                            <option>عقد </option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="experience_level" class="form-label fw-medium">مستوى الخبرة <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg" id="experience_level" name="experience_level" required>
                            <option value="">اختر المستوى</option>
                            <option>مبتدئ (0-2 سنة)</option>
                            <option>متوسط (2-5 سنوات)</option>
                            <option>خبير (5-10 سنوات)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="job_description" class="form-label fw-medium">وصف الوظيفة <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-lg" id="job_description" name="job_description" rows="5" required></textarea>
                    </div>
                </div>
            </div>

            <!-- قسم الموقع -->
            <div class="dynamic-section">
                <div class="section-header">
                    <h3 class="h4 text-primary fw-semibold">
                        <i class="fas fa-map-marked-alt me-2"></i>تفاصيل الموقع
                    </h3>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-medium">نوع الموقع <span class="text-danger">*</span></label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="location_type" id="remote" value="remote" required>
                                    <label class="form-check-label" for="remote">عن بُعد</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="location_type" id="hybrid" value="hybrid">
                                    <label class="form-check-label" for="hybrid">هجين</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="location_type" id="onsite" value="onsite">
                                    <label class="form-check-label" for="onsite">حضوري</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="location" class="form-label fw-medium">الموقع الجغرافي</label>
                        <input type="text" class="form-control form-control-lg" id="location" name="location">
                    </div>

                    <div class="col-md-6">
                        <label for="vacancies" class="form-label fw-medium">عدد الشواغر <span class="text-danger">*</span></label>
                        <input type="number" class="form-control form-control-lg" id="vacancies" name="vacancies" min="1" required>
                    </div>

                    <div class="col-md-6">
                        <label for="expiration_date" class="form-label fw-medium">تاريخ الانتهاء <span class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-lg" id="expiration_date" name="expiration_date" required>
                    </div>
                </div>
            </div>

            <!-- قسم الراتب -->
            <div class="dynamic-section">
                <div class="section-header">
                    <h3 class="h4 text-primary fw-semibold">
                        <i class="fas fa-money-check-alt me-2"></i>تفاصيل الراتب
                    </h3>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">نوع الراتب <span class="text-danger">*</span></label>
                        <div class="d-flex gap-4 mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="salary_type" id="fixedSalary" value="fixed" required>
                                <label class="form-check-label" for="fixedSalary">راتب ثابت</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="salary_type" id="salaryRange" value="range">
                                <label class="form-check-label" for="salaryRange">نطاق رواتب</label>
                            </div>
                        </div>

                        <div id="fixedSalaryFields" class="salary-input-group">
                            <input type="number" class="form-control form-control-lg" id="fixed_salary" name="fixed_salary" placeholder="المبلغ">
                            <select class="form-select form-select-lg" id="fixed_salary_currency" name="fixed_salary_currency">
                                <option value="SAR">SAR</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                            <select class="form-select form-select-lg" id="fixed_salary_period" name="fixed_salary_period">
                                <option value="شهري">شهري</option>
                                <option value="سنوي">سنوي</option>
                            </select>
                        </div>

                        <div id="salaryRangeFields" class="salary-input-group d-none">
                            <input type="number" class="form-control form-control-lg" id="salary_min" name="salary_min" placeholder="الحد الأدنى">
                            <input type="number" class="form-control form-control-lg" id="salary_max" name="salary_max" placeholder="الحد الأقصى">
                            <select class="form-select form-select-lg" id="salary_range_currency" name="salary_range_currency">
                                <option value="SAR">SAR</option>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                            <select class="form-select form-select-lg" id="salary_range_period" name="salary_range_period">
                                <option value="شهري">شهري</option>
                                <option value="سنوي">سنوي</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- قسم المهارات -->
            <div class="dynamic-section">
                <div class="section-header">
                    <h3 class="h4 text-primary fw-semibold">
                        <i class="fas fa-tools me-2"></i>المتطلبات الفنية
                    </h3>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="required_skills" class="form-label fw-medium">المهارات المطلوبة <span class="text-danger">*</span></label>
                        <div class="tag-container" id="skillsContainer">
                            <input type="text" class="form-control form-control-lg" id="required_skills" name="required_skills"
                                   placeholder="أضف مهارة ثم اضغط Enter">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="technical-tools-group">
                            <label class="form-label fw-medium">الأدوات التقنية</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-lg" id="technical_tools_input" name="technical_tools_input"
                                       placeholder="اسم الأداة التقنية">
                                <select class="form-select form-select-lg" id="tool_proficiency" name="tool_proficiency">
                                    <option value="basic">مبتدئ</option>
                                    <option value="intermediate">متوسط</option>
                                    <option value="advanced">متقدم</option>
                                </select>
                                <button class="btn btn-outline-secondary" type="button" id="addToolBtn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="tag-container" id="toolsContainer"></div>
                            <input type="hidden" id="technical_tools" name="technical_tools">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="qualifications" class="form-label fw-medium">المؤهلات العلمية</label>
                        <textarea class="form-control form-control-lg" id="qualifications" name="qualifications" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- قسم إضافي -->
            <div class="dynamic-section">
                <div class="section-header">
                    <h3 class="h4 text-primary fw-semibold">
                        <i class="fas fa-info-circle me-2"></i>معلومات إضافية
                    </h3>
                </div>

                <div class="row g-4">
                    <div class="col-12">
                        <label for="application_instructions" class="form-label fw-medium">تعليمات التقديم <span class="text-danger">*</span></label>
                        <textarea class="form-control form-control-lg" id="application_instructions" name="application_instructions" rows="3" required></textarea>
                    </div>

                    <div class="col-12">
                        <label for="additional_info" class="form-label fw-medium">معلومات إضافية</label>
                        <textarea class="form-control form-control-lg" id="additional_info" name="additional_info" rows="3"></textarea>
                    </div>

                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                            <label class="form-check-label fw-medium" for="is_active">العرض نشط</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- أزرار التحكم -->
            <div class="d-flex justify-content-between mt-5">
                <button type="reset" class="btn btn-lg btn-outline-secondary">
                    <i class="fas fa-undo me-2"></i>إعادة تعيين
                </button>
                <div>
                    <button type="button" class="btn btn-lg btn-outline-primary me-3" id="previewBtn">
                        <i class="fas fa-eye me-2"></i>معاينة
                    </button>
                    <button type="submit" class="btn btn-lg btn-primary">
                        <i class="fas fa-save me-2"></i>حفظ العرض
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">معاينة العرض الوظيفي</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body preview-card p-4" id="previewContent"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Salary Type Toggle
        const salaryTypeRadios = document.querySelectorAll('input[name="salary_type"]');
        const fixedFields = document.getElementById('fixedSalaryFields');
        const rangeFields = document.getElementById('salaryRangeFields');

        salaryTypeRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                fixedFields.classList.toggle('d-none', radio.id !== 'fixedSalary');
                rangeFields.classList.toggle('d-none', radio.id !== 'salaryRange');
            });
        });

        // Skills Management
        const skillsInput = document.getElementById('required_skills');
        const skillsContainer = document.getElementById('skillsContainer');

        skillsInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && skillsInput.value.trim()) {
                e.preventDefault();
                createSkillTag(skillsInput.value.trim());
                skillsInput.value = '';
            }
        });

        function createSkillTag(skill) {
            const tag = document.createElement('div');
            tag.className = 'skill-tag';
            tag.innerHTML = `
            ${skill}
            <span class="tag-remove" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </span>
        `;
            skillsContainer.insertBefore(tag, skillsInput);
        }

        // Technical Tools Management
        const toolInput = document.getElementById('technical_tools_input');
        const addToolBtn = document.getElementById('addToolBtn');
        const toolsContainer = document.getElementById('toolsContainer');
        const toolsHidden = document.getElementById('technical_tools');

        addToolBtn.addEventListener('click', () => {
            if (toolInput.value.trim()) {
                const tool = {
                    name: toolInput.value.trim(),
                    proficiency: document.getElementById('tool_proficiency').value,
                    // mandatory: document.getElementById('tool_mandatory').checked
                };
                addToolToUI(tool);
                updateToolsStorage();
                toolInput.value = '';
            }
        });

        function addToolToUI(tool) {
            const toolElement = document.createElement('div');
            toolElement.className = 'skill-tag';
            toolElement.innerHTML = `
            ${tool.name} (${tool.proficiency})
            <span class="tag-remove" onclick="this.parentElement.remove(); updateToolsStorage()">
                <i class="fas fa-times"></i>
            </span>
        `;
            toolsContainer.appendChild(toolElement);
        }

        function updateToolsStorage() {
            const tools = Array.from(toolsContainer.children)
                .filter(el => el.className === 'skill-tag')
                .map(el => ({
                    name: el.textContent.split('(')[0].trim(),
                    proficiency: el.textContent.match(/\((.*?)\)/)[1]
                    // mandatory: el.textContent.includes('(إجباري)')
                }));
            toolsHidden.value = JSON.stringify(tools);
        }

        // Form Validation and Submission
        const form = document.getElementById('jobForm');
        form.addEventListener('submit', (e) => {
            e.preventDefault();  // Prevent form submission

            if (!form.checkValidity()) {
                e.stopPropagation();  // Stop form submission if validation fails
                form.classList.add('was-validated');  // Show validation feedback
                return;
            }

            const formData = {
                job_title: document.getElementById('job_title').value,
                job_description: document.getElementById('job_description').value,
                job_category: document.getElementById('job_category').value,
                job_type: document.getElementById('job_type').value,
                experience_level: document.getElementById('experience_level').value,
                location_type: document.querySelector('input[name="location_type"]:checked')?.value,
                location: document.getElementById('location').value,
                vacancies: document.getElementById('vacancies').value,
                expiration_date: document.getElementById('expiration_date').value,
                salary_type: document.querySelector('input[name="salary_type"]:checked')?.value,
                fixed_salary: document.getElementById('fixed_salary').value,
                fixed_salary_currency: document.getElementById('fixed_salary_currency').value,
                fixed_salary_period: document.getElementById('fixed_salary_period').value,
                salary_min: document.getElementById('salary_min').value,
                salary_max: document.getElementById('salary_max').value,
                salary_range_currency: document.getElementById('salary_range_currency').value,
                salary_range_period: document.getElementById('salary_range_period').value,
                required_skills: Array.from(skillsContainer.querySelectorAll('.skill-tag'))
                    .map(tag => tag.textContent.trim().replace('×', '')),
                technical_tools: JSON.parse(document.getElementById('technical_tools').value),
                qualifications: document.getElementById('qualifications').value,
                application_instructions: document.getElementById('application_instructions').value,
                additional_info: document.getElementById('additional_info').value,
                is_active: document.getElementById('is_active').checked
            };



            // Send the form data to the server
            fetch('/offers', {  // Replace with your endpoint
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: JSON.stringify(formData)  // Send form data as JSON
            })
                .then(response => response.json())  // Parse JSON response from Laravel
                .then(data => {
                    console.log('Success:', data);
                    // Handle success (e.g., show a success message or redirect)
                    alert('Job has been submitted successfully!');
                })
                .catch(error => {
                    // console.error('Error:', error);
                    // Handle error (e.g., show an error message)
                    alert('There was an error submitting your job.');
                });
        });

        // Preview Handler
        document.getElementById('previewBtn').addEventListener('click', () => {
            const previewContent = document.getElementById('previewContent');
            previewContent.innerHTML = `
            <h4>${document.getElementById('job_title').value}</h4>
            <p>التصنيف: ${document.getElementById('job_category').value}</p>
            <!-- Add other preview elements -->
        `;
            new bootstrap.Modal('#previewModal').show();
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

