@extends('layouts.app')

@section('content')
    <div class="container py-5" dir="ltr">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Modern Card Design -->
                <div class="story-card shadow-sm border-0 rounded-4 overflow-hidden">
                    <!-- Card Header with Gradient -->
                    <div class="story-header bg-gradient-primary text-white p-4">
                        <h2 class="h4 mb-0 text-end fw-bold">
                            <i class="fas fa-book-open me-2"></i> شارك قصتك
                        </h2>
                    </div>

                    <!-- Card Body -->
                    <div class="story-body bg-white p-4 p-md-5">
                        <form method="POST" action="{{ isset($story) ? route('story.update', $story->id) : route('story.store') }}"
                            enctype="multipart/form-data" id="storyForm" class="needs-validation" novalidate>
                          @csrf

                          <!-- Name Field -->
                          <div class="mb-4">
                              <label for="name" class="form-label text-end d-block mb-2 fw-semibold">الاسم الكامل</label>
                              <div class="input-group">
                                  <span class="input-group-text bg-transparent"><i class="fas fa-user"></i></span>
                                  <input type="text" class="form-control text-end @error('name') is-invalid @enderror" id="name" name="name"
                                         value="{{ old('name', $story->name ?? '') }}" placeholder="أدخل اسمك" required>
                                  @error('name')
                                  <div class="invalid-feedback text-end">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>

                          <!-- Position Field -->
                          <div class="mb-4">
                              <label for="position" class="form-label text-end d-block mb-2 fw-semibold">المسمى الوظيفي</label>
                              <div class="input-group">
                                  <span class="input-group-text bg-transparent"><i class="fas fa-briefcase"></i></span>
                                  <input type="text" class="form-control text-end @error('position') is-invalid @enderror" id="position"
                                         name="position" value="{{ old('position', $story->position ?? '') }}" placeholder="أدخل المسمى الوظيفي" required>
                                  @error('position')
                                  <div class="invalid-feedback text-end">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>

                          <!-- Image Upload -->
                          <div class="mb-4">
                              <label for="image" class="form-label text-end d-block mb-2 fw-semibold">الصورة الشخصية</label>
                              <div class="file-upload-wrapper">
                                  <div class="input-group">
                                      <input type="file" class="form-control text-end @error('image') is-invalid @enderror" id="image"
                                             name="image" accept="image/*" onchange="previewImage(this)">
                                      <button class="btn btn-outline-secondary" type="button" onclick="clearImage()">
                                          <i class="fas fa-times"></i>
                                      </button>
                                      @error('image')
                                      <div class="invalid-feedback text-end">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <small class="text-muted text-end d-block mt-1">يجب أن تكون الصورة بصيغة JPG أو PNG (الحجم الأقصى 2MB)</small>


                              </div>
                          </div>

                          <!-- Description Field -->
                          <div class="mb-4">
                              <label for="des" class="form-label text-end d-block mb-2 fw-semibold">القصة الشخصية</label>
                              <textarea class="form-control text-end @error('des') is-invalid @enderror" id="des" name="des" style="height: 150px"
                                        placeholder="اكتب قصتك هنا..." required>{{ old('des', $story->des ?? '') }}</textarea>
                              <div class="d-flex justify-content-between mt-2">
                                  <small class="text-muted text-end">(يجب أن لا تقل عن 40 حرفاً)</small>
                                  <span class="text-muted" id="char-counter">0/40</span>
                              </div>
                              @error('des')
                              <div class="invalid-feedback text-end">{{ $message }}</div>
                              @enderror
                          </div>

                          <!-- Submit Button -->
                          <div class="d-flex justify-content-between mt-5" dir="rtl">
                              <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4 rounded-pill">
                                  <i class="fas fa-arrow-right me-2"></i> رجوع
                              </a>
                              <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                  <i class="fas fa-share me-2"></i>
                                  {{ isset($story) ? 'تحديث القصة' : 'مشاركة القصة' }}
                              </button>
                          </div>
                      </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .bg-gradient-primary {
                background: linear-gradient(135deg, #3F37DF 0%, #1a237e 100%);
            }

            .story-card {
                border: 1px solid rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .story-card:hover {
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            .story-header {
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            }

            .form-control {
                border-radius: 0.375rem !important;
                border: 1px solid #ced4da;
                padding: 0.5rem 1rem;
            }

            .form-control:focus {
                border-color: #4b6cb7;
                box-shadow: 0 0 0 0.25rem rgba(75, 108, 183, 0.25);
            }

            .input-group-text {
                border-right: 0;
                border-left: 1px solid #ced4da;
            }

            .btn-primary {
                background-color: #3F37DF;
                border-color: #3F37DF;
            }

            .btn-primary:hover {
                background-color: #3a5a9c;
                border-color: #3a5a9c;
            }

            label {
                color: #495057;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Character counter
            document.getElementById('des').addEventListener('input', function() {
                const charCount = this.value.length;
                document.getElementById('char-counter').textContent = `${charCount}/40`;
            });

            // Image preview
            function previewImage(input) {
                const preview = document.getElementById('imagePreview');
                const previewImg = preview.querySelector('img');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        preview.classList.remove('d-none');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Clear image
            function clearImage() {
                document.getElementById('image').value = '';
                document.getElementById('imagePreview').classList.add('d-none');
            }

            // Form validation
            (function() {
                'use strict';

                // Fetch form to apply custom Bootstrap validation styles
                const form = document.getElementById('storyForm');

                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        if (!confirm('هل أنت متأكد من مشاركة قصتك؟ سيتم نشرها بعد المراجعة.')) {
                            event.preventDefault();
                        }
                    }

                    form.classList.add('was-validated');
                }, false);
            })();
        </script>
    @endpush
@endsection
