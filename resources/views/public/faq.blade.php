@extends('layouts.public')

@section('title', 'FAQ - Prodi SI UNPARI')

@section('content')
<style>
    .faq-content {
        padding: 60px 0;
        background: #fff;
    }
    
    .faq-content .container {
        max-width: 800px;
    }
    
    .faq-item {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        margin-bottom: 12px;
        overflow: hidden;
        transition: box-shadow 0.3s;
    }
    
    .faq-item:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }
    
    .faq-question {
        display: flex;
        align-items: center;
        padding: 20px 24px;
        cursor: pointer;
        background: #fafafa;
        transition: background 0.2s;
        gap: 16px;
    }
    
    .faq-question:hover {
        background: #f5f5f5;
    }
    
    .faq-question .icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .faq-question .icon i {
        color: #fff;
        font-size: 0.85rem;
    }
    
    .faq-question h4 {
        flex: 1;
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
    }
    
    .faq-question .toggle-icon {
        color: #999;
        transition: transform 0.3s;
        font-size: 0.9rem;
    }
    
    .faq-item.active .faq-question .toggle-icon {
        transform: rotate(180deg);
    }
    
    .faq-item.active .faq-question {
        background: #f0ebff;
    }
    
    .faq-answer {
        display: none;
        padding: 20px 24px 24px 76px;
        color: #555;
        line-height: 1.8;
        border-top: 1px solid #e0e0e0;
    }
    
    .faq-item.active .faq-answer {
        display: block;
    }
    
    .faq-empty {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }
    
    .faq-empty i {
        font-size: 3rem;
        margin-bottom: 16px;
        display: block;
        color: #ddd;
    }
</style>

<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>FAQ</h1>
        <p>Pertanyaan yang sering diajukan tentang Program Studi Sistem Informasi</p>
    </div>
</section>

<!-- Content -->
<section class="faq-content">
    <div class="container">
        
        @if($faqs->count() > 0)
            @foreach($faqs as $index => $faq)
            <div class="faq-item {{ $index === 0 ? 'active' : '' }}" id="faq{{ $faq->id }}">
                <div class="faq-question" onclick="toggleFaq({{ $faq->id }})">
                    <div class="icon">
                        <i class="fas fa-question"></i>
                    </div>
                    <h4>{{ $faq->pertanyaan }}</h4>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div class="faq-answer">
                    {!! nl2br(e($faq->jawaban)) !!}
                </div>
            </div>
            @endforeach
        @else
            <div class="faq-empty">
                <i class="fas fa-question-circle"></i>
                <p>Belum ada FAQ. Silakan hubungi kami untuk pertanyaan Anda.</p>
            </div>
        @endif
        
    </div>
</section>
@endsection

@section('scripts')
<script>
function toggleFaq(id) {
    const item = document.getElementById('faq' + id);
    item.classList.toggle('active');
}
</script>
@endsection
