@extends('layouts.app')

@section('content')
<div class="container-fluid vh-100 p-0">
    <div class="row g-0 h-100">
        <!-- Main Chat Area -->
        <div class="col h-100 d-flex flex-column">
            <!-- Chat Header -->
            <div class="bg-white p-3 border-bottom text-end shadow-sm">
                <h4 class="mb-0 fw-bold">{{ $division->title }}</h4>
            </div>

            <!-- Messages Area - Changed to align items to start -->
            <div class="flex-grow-1 overflow-auto p-4 chat-container" style="background-color: #f5f7fb; display: flex; flex-direction: column; align-items: flex-start;">
                @foreach ($inquiries as $inquiry)
                    @if ($inquiry->respond == 'send')
                        <!-- Sent Message -->
                        <div class="d-flex justify-content-end mb-3" style="width: 100%;">
                            <div class="message-bubble bg-white rounded-4 p-3 shadow sent" style="max-width: 75%; margin-bottom: 12px;">
                                @if ($inquiry->file)
                                    @php
                                        $extension = pathinfo($inquiry->file, PATHINFO_EXTENSION);
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                                    @endphp
                                    @if (in_array(strtolower($extension), $imageExtensions))
                                        <div class="mb-3 text-center">
                                            <img src="{{ asset('storage/' . $inquiry->file) }}"
                                                 class="img-fluid rounded"
                                                 style="max-height: 220px;">
                                            <a href="{{ asset('storage/' . $inquiry->file) }}" download
                                               class="btn btn-sm btn-outline-primary mt-2">
                                                <i class="fas fa-download"></i> تحميل
                                            </a>
                                        </div>
                                    @else
                                        <div class="mb-3 d-flex align-items-center">
                                            <span class="badge bg-secondary me-2">{{ strtoupper($extension) }}</span>
                                            <a href="{{ asset('storage/' . $inquiry->file) }}" download
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-download"></i> تحميل
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                <p class="mb-2" style="font-size: 0.95rem;">{{ $inquiry->description }}</p>
                                <small class="text-muted d-block text-end message-time">
                                    @if ($inquiry->created_at->isToday())
                                        {{ $inquiry->created_at->format('h:i A') }}
                                    @else
                                        {{ $inquiry->created_at->format('Y-m-d') }}
                                    @endif
                                </small>
                            </div>
                        </div>
                    @else
                        <!-- Received Message -->
                        <div class="d-flex justify-content-start mb-3" style="width: 100%;">
                            <div class="message-bubble bg-primary text-white rounded-4 p-3 shadow received" style="max-width: 75%; margin-bottom: 12px;">
                                @if ($inquiry->file)
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset('storage/' . $inquiry->file) }}"
                                             class="img-fluid rounded"
                                             style="max-height: 220px;">
                                    </div>
                                @endif
                                <p class="mb-2" style="font-size: 0.95rem;">{{ $inquiry->description }}</p>
                                <small class="text-white-50 d-block message-time">
                                    @if ($inquiry->created_at->isToday())
                                        {{ $inquiry->created_at->format('h:i A') }}
                                    @else
                                        {{ $inquiry->created_at->format('Y-m-d') }}
                                    @endif
                                </small>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if (count($inquiries) == 0)
                    <div class="w-100 d-flex flex-column justify-content-start align-items-center text-center text-muted" style="margin-top: 20px;">
                        <i class="far fa-comment-dots fa-3x mb-3 opacity-25"></i>
                        <h4 class="mb-2">لا توجد رسائل بعد</h4>
                        <p class="text-muted">ابدأ المحادثة بإرسال رسالة جديدة</p>
                    </div>
                @endif
            </div>

            <!-- Input Area -->
            <div class="bg-white p-3 border-top shadow-sm">
                <form action="{{route('supervisor.save-inquiry', ['division' => $division->id, 'graduate' => $graduate->id])}}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex align-items-center message-input-container p-2 bg-light rounded-4" style="padding: 10px 15px;">
                        <button type="button" class="btn btn-link text-muted px-2" onclick="document.getElementById('file-input').click()">
                            <i class="fas fa-paperclip fs-5"></i>
                        </button>
                        <input type="file" name="file" id="file-input" class="d-none">

                        <textarea class="form-control border-0 bg-light flex-grow-1 mx-2"
                                placeholder="اكتب رسالتك هنا..."
                                rows="1"
                                name="description"
                                style="resize: none; padding: 10px; font-size: 0.95rem;"></textarea>

                        <button type="submit" class="btn btn-primary rounded-circle p-2" style="width: 42px; height: 42px;">
                            <i class="fas fa-arrow-up"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .message-bubble {
        position: relative;
        padding: 12px 16px;
        line-height: 1.5;
        transition: all 0.2s ease;
    }

    .message-bubble.sent {
        background-color: #ffffff;
        border-top-left-radius: 0 !important;

        margin-right: auto; /* Changed to auto to push to right */
        border: 1px solid #e9ecef;
    }

    .message-bubble.received {
        background-color: #0d6efd;
        border-top-right-radius: 0 !important;
        margin-left: auto; /* Changed to auto to keep on left */
    }

    .message-bubble:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.08) !important;
    }

    .message-time {
        font-size: 0.75rem;
        opacity: 0.8;
        margin-top: 4px;
    }

    .chat-container {
        scroll-behavior: smooth;
        background-color: #f5f7fb;
    }

    .message-input-container {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .message-input-container:focus-within {
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
        border-color: #86b7fe;
    }

    textarea:focus {
        outline: none !important;
        box-shadow: none !important;
    }
</style>
@endsection
