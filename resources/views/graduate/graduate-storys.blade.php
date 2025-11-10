
@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: 'Tajawal', sans-serif;
        background-color: #f8f9fc;
        text-align: right;
    }

    .gradient-header {
        background: linear-gradient(135deg, #3F37DF 0%, #1a237e 100%);
        color: white;
        padding: 1rem 0;
        margin-bottom: 2rem;
        margin-top: -30px;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .story-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 30px;
        overflow: hidden;
        background: white;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .story-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .story-img-container {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .story-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .story-card:hover .story-img {
        transform: scale(1.05);
    }

    .story-body {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .story-title {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 1.3rem;
    }

    .story-position {
        color: #0066cc;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 0.95rem;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
    }

    .story-text {
        color: #555;
        line-height: 1.8;
        margin-bottom: 0;
        flex-grow: 1;
        font-size: 0.95rem;
    }

    .section-title {
        font-weight: 800;
        color: white;

        font-size: 2.2rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .section-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
    }

    .pagination .page-item.active .page-link {
        background-color: #0066cc;
        border-color: #0066cc;
    }

    .pagination .page-link {
        color: #0066cc;
        border-radius: 8px;
        margin: 0 3px;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .pagination .page-link:hover {
        background-color: #f0f0f0;
    }

    .empty-state {
        text-align: center;
        padding: 50px 0;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 20px;
    }
</style>
<div id="content">


    <!-- Begin Page Content -->
    <div class="gradient-header text-center">
        <div class="container position-relative py-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="header-content text-center flex-grow-1">
                    <h2 class="section-title mb-2" style="font-size: 1.8rem;">قصص نجاح خريجينا</h2>
                    <p class="section-subtitle mb-0" style="font-size: 0.95rem;">اكتشف رحلات خريجينا المتميزين وإنجازاتهم المهنية الملهمة</p>
                </div>
                @if($existingStory)
                <a href="{{ route('story.edit', $existingStory->id) }}"
                   class="btn btn-sm btn-warning rounded-pill px-3 py-1 position-absolute"
                   style="left: 1.5rem; top: 1.5rem; border: 1px solid rgba(255,255,255,0.3);">
                    <i class="fas fa-edit ms-1"></i>
                    <span>تعديل قصتي</span>
                </a>
            @else
                <a href="{{ route('story.create') }}"
                   class="btn btn-sm btn-light rounded-pill px-3 py-1 position-absolute"
                   style="left: 1.5rem; top: 1.5rem; border: 1px solid rgba(255,255,255,0.3);">
                    <i class="fas fa-plus ms-1"></i>
                    <span>شارك قصتك</span>
                </a>
            @endif

            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row">
            @forelse($graduateStorys as $story)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="story-card">
                    <div class="story-img-container">
                        <img src="{{ asset('storage/' . $story->image) }}" class="story-img" alt="{{ $story->name }}">
                        {{-- <img src="img/undraw_profile.svg" class="story-img" alt="{{ $story->name }}"> --}}
                    </div>
                    <div class="story-body">
                        <h4 class="story-title">{{ $story->name }}</h4>
                        <h6 class="story-position">{{ $story->position }}</h6>
                        <p class="story-text">{{ $story->des }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h3>لا توجد قصص متاحة حالياً</h3>
                    <p>سيتم إضافة قصص جديدة قريباً</p>
                </div>
            </div>
            @endforelse
        </div>

        @if($graduateStorys->hasPages())
        <div class="d-flex justify-content-center mt-5" dir="rtl">
            <nav>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($graduateStorys->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $graduateStorys->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($graduateStorys->getUrlRange(1, $graduateStorys->lastPage()) as $page => $url)
                        @if ($page == $graduateStorys->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($graduateStorys->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $graduateStorys->nextPageUrl() }}" rel="next">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif
    </div>
    <!-- /.container-fluid -->

</div>

@endsection
