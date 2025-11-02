<div class="card mclaren-card h-100">
    <img src="{{ asset($img) }}" class="card-img-top" onerror="this.onerror=null;this.src='https://placehold.co/800x500/1C1C1C/E4002B?text={{ $title }}+Image';" alt="{{ $title }}">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text flex-grow-1">
            **{{ $desc }}**
        </p>
        <a href="{{ route('car.details', ['model' => $model]) }}" class="btn btn-primary mt-auto">Xem chi tiết</a>
    </div>