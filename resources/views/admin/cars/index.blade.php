@extends('admin.layouts.app')

@section('title', 'Quản lý Dòng Xe')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Danh sách các mẫu xe McLaren</h4>
        <a href="{{ route('admin.cars.create') }}" class="btn btn-mc"><i class="fas fa-plus me-1"></i> Thêm xe mới</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Xe</th>
                        <th>Series</th>
                        <th>Ảnh chính</th>
                        <th>Slug</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td><strong>{{ $car->name }}</strong></td>
                        <td>{{ $car->series }}</td>
                        <td>
                            {{-- 💡 SỬA: Thêm tiền tố 'storage/' để ảnh hiển thị --}}
                            <img src="{{ asset('storage/' . $car->image_url) }}" alt="{{ $car->name }}" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;" onerror="this.onerror=null;this.src='{{ asset('placeholder.png') }}';">
                        </td>
                        <td>{{ $car->model_key }}</td>
                        <td>
                            {{-- 💡 SỬA: Dùng route admin.cars.edit và truyền Model/ID --}}
                            <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-warning text-dark me-2"><i class="fas fa-edit"></i> Sửa</a>
                            
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa xe {{ $car->name }} không?')"><i class="fas fa-trash"></i> Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Không có mẫu xe nào được tìm thấy. Vui lòng thêm mới.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{ $cars->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection