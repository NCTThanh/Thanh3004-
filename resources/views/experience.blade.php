@extends('layouts.app')
@section('title', 'Trải Nghiệm McLaren')

@push('styles')
<style>
   
    :root{--mclaren-orange:#FF7E00;--dark-bg:#050505;} body{background:var(--dark-bg);color:#fff;}
    .exp-hero { height: 80vh; position: relative; display: flex; align-items: center; justify-content: center; }
    .event-row { display: flex; min-height: 500px; margin-bottom: 0; }
    .event-img-col, .event-text-col { flex: 1; }
    .event-img-col img { width: 100%; height: 100%; object-fit: cover; }
    .event-text-col { padding: 80px; display: flex; flex-direction: column; justify-content: center; background: #0f0f0f; }
    .event-row.reverse { flex-direction: row-reverse; }
    @media(max-width:992px){ .event-row, .event-row.reverse{ flex-direction: column; } }
</style>
@endpush

@section('content')
    {{-- HERO --}}
    <section class="exp-hero">
        <img src="https://mclaren.scene7.com/is/image/mclaren/Pure-McLaren-GT-Series-01:crop-16x9?wid=1920&hei=1080" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; opacity:0.5;">
        <div style="z-index:2; text-align:center;">
            <h1 class="display-2 fw-bold">PERFORMANCE IS AN ATTITUDE</h1>
        </div>
    </section>

    {{-- EVENTS LOOP --}}
    <section class="container-fluid p-0">
        @foreach($events as $event)
            {{-- Đảo chiều so le: Event chẵn thì reverse --}}
            <div class="event-row {{ $loop->iteration % 2 == 0 ? 'reverse' : '' }}">
                <div class="event-img-col">
                    <img src="{{ $event->image_url }}" alt="{{ $event->title }}">
                </div>
                <div class="event-text-col">
                    <span class="text-warning fw-bold ls-2">{{ $event->category }}</span>
                    <h2 class="display-4 fw-bold my-3">{{ $event->title }}</h2>
                    <p class="lead text-secondary mb-5">{{ $event->description }}</p>
                    <a href="{{ $event->link ?? '#' }}" class="btn btn-outline-light rounded-0 px-4 py-2" style="width:fit-content">KHÁM PHÁ</a>
                </div>
            </div>
        @endforeach
    </section>
@endsection