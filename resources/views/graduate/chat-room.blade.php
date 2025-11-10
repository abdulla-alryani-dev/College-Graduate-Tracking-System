@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #0066cc;
        --primary-light: #e6f0ff;
        --bg-color: #f7f9fc;
        --white: #ffffff;
        --text-dark: #2d3748;
        --text-light: #718096;
        --border: #e2e8f0;
        --success: #48bb78;
    }

    /* Base Styles */

    #app {
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Chat Layout */
    .chat-app {
        display: flex;
        height: 100%;
    }

    /* Sidebar */
    .chat-sidebar {
        width: 20vw;
        background: white;
        border-left: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    .chat-sidebar-header {
        padding: 16px;
    }

    .chat-sidebar-header h3 {
        margin: 0;
        font-size: 18px;
        color: var(--text-dark);
        font-weight: 700;
    }

    .contacts {
        flex: 1;
        overflow-y: auto;
        padding: 8px 0;
    }

    .contact {
        padding: 12px 16px;
        margin: 0 8px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
    }

    .contact:hover {
        background-color: var(--primary-light);
    }

    .contact.active {
        background-color: var(--primary);
        color: white;
    }

    .contact.active .contact-name,
    .contact.active .contact-desc {
        color: white;
    }



    .contact.active .contact-avatar {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .contact-info {
        flex: 1;
    }

    .contact-name {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }

    .contact-desc {
        font-size: 13px;
        color: var(--text-light);
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Chat Area */
    .chat-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        height: 90vh;
        position: relative;
        background: white;
        /* Fallback color */
        overflow: hidden;
        /* Keeps the diagonal clean */
    }

    /* Diagonal two-tone background */
    .chat-area::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg,
                #f5f9ff 0%,
                #f5f9ff 50%,
                white 50.1%,
                /* Slight overlap prevents jagged edges */
                white 100%);
        z-index: 0;
    }

    /* Ensure all content stays above the background */
    .chat-header,
    .messages,
    .input-area {
        position: relative;
        z-index: 1;
        /* Puts elements above the background */
    }

    /* Optional: Soften the diagonal line */
    .chat-area::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg,
                transparent 49.5%,
                rgba(255, 255, 255, 0.3) 50%,
                transparent 50.5%);
        z-index: 1;
    }

    .chat-header {
        padding: 16px 24px;
        display: flex;
        align-items: center;
    }

    .chat-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    /* Messages */
    .messages {
        flex: 1;
        overflow-y: scroll;
        padding: 24px;
        display: flex;
        flex-direction: column;
        z-index: 999;
    }

    .message {
        max-width: 65%;
        margin-bottom: 16px;
        position: relative;
    }

    .message-content {
        padding: 12px 16px;
        border-radius: 12px;
        line-height: 1.5;
        font-size: 15px;
        position: relative;
    }

    .received .message-content {
        background: var(--white);
        border: 1px solid var(--border);
        border-top-left-radius: 4px;

        min-width: 200px;

        color: var(--text-dark);
    }

    .sent .message-content {
        background: var(--primary);
        color: white;
        min-width: 200px;
        border-top-right-radius: 4px;

    }

    .message-time {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 4px;
        display: block;
    }

    .sent .message-time {
        text-align: left;
        color: rgba(255, 255, 255, 0.8);
    }

    .received .message-time {
        text-align: right;
    }

    .sent {
        align-self: flex-start;
    }

    .received {
        align-self: flex-end;
    }

    /* Input Area */
    .input-area {
        padding: 16px;
        background: white;
        border-top: 1px solid #e5e7eb;
        position: relative;
        z-index: 99;
    }

    .input-container {
        display: flex;
        align-items: flex-end;
        /* Align items to bottom */
        background: #f9fafb;
        border-radius: 24px;
        padding: 8px 12px 8px 16px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .message-input {
        flex: 1;
        border: none;
        background: transparent;
        padding: 12px 8px;
        font-family: 'Tajawal', sans-serif;
        font-size: 15px;
        outline: none;
        resize: none;
        min-height: 24px;
        max-height: 120px;
        line-height: 1.5;
        color: #1f2937;
        z-index: 99;
    }

    .attachment-button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: transparent;
        border: none;
        color: #6b7280;
        cursor: pointer;
        margin-right: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        z-index: 99;
    }

    .attachment-button:hover {
        background: #e5e7eb;
        color: #0066cc;
    }

    .send-button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #0066cc;
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-left: 8px;
        flex-shrink: 0;
    }

    .send-button:hover {
        background: #0052a3;
        transform: scale(1.05);
    }

    .send-button:disabled {
        background: #d1d5db;
        cursor: not-allowed;
    }

    /* Triangular clip for input container */
    .input-container::before {
        content: "";
        position: absolute;
        bottom: -8px;
        right: 20px;
        width: 16px;
        height: 16px;
        background: #f9fafb;
        transform: rotate(45deg);
        z-index: 1;
        border-right: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
    }

    /* Empty State */
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        text-align: center;
        padding: 40px;
    }

    .empty-icon {
        font-size: 48px;
        color: var(--border);
        margin-bottom: 16px;
    }

    .empty-title {
        font-size: 18px;
        color: var(--text-dark);
        margin-bottom: 8px;
        font-weight: 600;
    }

    .empty-description {
        font-size: 14px;
        color: var(--text-light);
        max-width: 400px;
        line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .chat-app {
            flex-direction: column;
        }

        .chat-sidebar {
            width: 100%;
            height: 300px;
            border-left: none;
            border-bottom: 1px solid var(--border);
        }

        .chat-area {
            height: calc(100% - 300px);
        }
    }
</style>
<div id="content">


    <!-- Begin Page Content -->
    <div class="container-fluid p-0" dir="ltr">
        <div class="chat-app">
            <!-- Sidebar -->
            <div class="chat-sidebar text-end" dir='rtl'>
                <div class="chat-sidebar-header">
                    <h3>جهات الاستفسار</h3>
                </div>
                <div class="contacts">
                    @foreach ($activeDivisions as $div)
                    <a href="{{ route('division.chat-room', $div->id) }}">
                        <div class="contact @if($division->id == $div->id) active @endif">
                            <div class="contact-info">
                                <div class="contact-name">{{ $div->title }}</div>
                                <p class="contact-desc">
                                    {{ \Illuminate\Support\Str::limit($div->description, 40, '...') }}
                                </p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Chat Area -->
            <!-- Chat Area -->
            <div class="chat-area" dir="rtl">
                <div class="chat-header text-end">
                    <h3 class="chat-title text-end">{{ $division->title }}</h3>
                </div>

                <div class="messages">
                        @foreach ($inquiries as $inquiry)
                            @if ($inquiry->respond == 'send')
                                <div class="message sent">
                                    @if ($inquiry->file)
                                        @php
                                            $extension = pathinfo($inquiry->file, PATHINFO_EXTENSION);
                                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                                        @endphp
                                        @if (in_array(strtolower($extension), $imageExtensions))
                                            <div class="chat-fit-box sent image-container">
                                                <img src="{{ asset('storage/' . $inquiry->file) }}" alt="Uploaded File"
                                                    class="img-fluid rounded">
                                                <a href="{{ asset('storage/' . $inquiry->file) }}" download
                                                    class="download-btn">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                        @else
                                            <div class="chat-fit-box sent file-box">
                                                <span class="file-extension">{{ strtoupper($extension) }}</span>
                                                <a href="{{ asset('storage/' . $inquiry->file) }}" download
                                                    class="download-btn">
                                                    <i class="fas fa-download"></i> تحميل
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="message-content">
                                        {{ $inquiry->description }}
                                        <span class="message-time">
                                            @if ($inquiry->created_at->isToday())
                                                {{ $inquiry->created_at->format('h:i A') }}
                                            @else
                                                {{ $inquiry->created_at->format('Y-m-d') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="message received">
                                    @if ($inquiry->file)
                                        <div class="chat-fit-box received">
                                            <img src="{{ asset('storage/' . $inquiry->file) }}" alt="Uploaded File"
                                                class="img-fluid rounded">
                                        </div>
                                    @endif
                                    <div class="message-content">
                                        {{ $inquiry->description }}
                                        <span class="message-time">
                                            @if ($inquiry->created_at->isToday())
                                                {{ $inquiry->created_at->format('h:i A') }}
                                            @else
                                                {{ $inquiry->created_at->format('Y-m-d') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @if (count($inquiries) == 0)
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="far fa-comment-dots"></i>
                                </div>
                                <h3 class="empty-title">لا توجد رسائل بعد</h3>
                                <p class="empty-description">ابدأ المحادثة بإرسال رسالة جديدة</p>
                            </div>
                        @endif
                </div>

                <div class="input-area">
                    <div class="input-container">
                        <button class="attachment-button">
                            <i class="fas fa-paperclip"></i>
                        </button>
                        <form action="{{ route('save.inquiry', ['id' => $division->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" class="d-none" id="file-input">
                            <textarea class="message-input" placeholder="اكتب رسالتك هنا..." rows="1" name="description"></textarea>
                            <button type="submit" class="send-button">
                                <i class="fas fa-arrow-up"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
