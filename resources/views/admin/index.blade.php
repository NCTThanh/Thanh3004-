@extends('admin.layouts.app')

@section('title', 'Tổng quan hệ thống')

@section('content')
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-3 card-stat shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted text-uppercase">Tổng số Xe</h5>
                    <h1 class="display-4 fw-bold">{{ $totalCars }}</h1>
                    <p class="card-text"><a href="{{ route('admin.cars.index') }}" class="text-decoration-none text-danger">Quản lý xe <i class="fas fa-arrow-right fa-xs"></i></a></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 card-stat shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted text-uppercase">Liên hệ mới</h5>
                    <h1 class="display-4 fw-bold text-danger">{{ $totalSubmissions }}</h1>
                    <p class="card-text"><a href="{{ route('admin.contacts.index') }}" class="text-decoration-none text-danger">Xem chi tiết <i class="fas fa-arrow-right fa-xs"></i></a></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 card-stat shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted text-uppercase">Tổng số Khách hàng</h5>
                    <h1 class="display-4 fw-bold">{{ $totalUsers }}</h1>
                    <p class="card-text"><a href="#" class="text-decoration-none text-danger">Quản lý User <i class="fas fa-arrow-right fa-xs"></i></a></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <h4 class="mb-3 text-uppercase">Yêu cầu liên hệ gần nhất</h4>
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Chủ đề</th>
                                <th>Ngày gửi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestSubmissions as $sub)
                            <tr>
                                <td>{{ $sub->name }}</td>
                                <td>{{ $sub->email }}</td>
                                <td>{{ Str::limit($sub->subject, 50) }}</td>
                                <td>{{ $sub->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Chưa có yêu cầu liên hệ nào.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection