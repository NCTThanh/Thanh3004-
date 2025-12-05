@extends('admin.layouts.app')

@section('title', 'Quản lý Người dùng')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Danh sách Khách hàng</h4>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Trạng thái</th>
                        <th>Ngày đăng ký</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_blocked)
                                    <span class="badge bg-danger">Đã khóa</span>
                                @else
                                    <span class="badge bg-success">Hoạt động</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                            <td>
                                {{-- Nút Khóa/Mở Khóa --}}
                                <form action="{{ route('admin.users.toggleBlock', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $user->is_blocked ? 'btn-success' : 'btn-warning' }}" 
                                            onclick="return confirm('Bạn có chắc muốn {{ $user->is_blocked ? 'MỞ KHÓA' : 'KHÓA' }} tài khoản này?')">
                                        {{ $user->is_blocked ? 'Mở Khóa' : 'Khóa' }}
                                    </button>
                                </form>
                                
                                {{-- Nút Đổi Mật khẩu (Sẽ cần thêm Modal cho tính năng resetPassword) --}}
                                <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#resetPasswordModal-{{ $user->id }}">
                                    Reset Mật khẩu
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Không có người dùng nào (trừ Admin).</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
    
    {{-- MODAL Reset Password (Cần thêm vào cuối file) --}}
    @foreach($users as $user)
    <div class="modal fade" id="resetPasswordModal-{{ $user->id }}" tabindex="-1" aria-labelledby="resetPasswordModalLabel-{{ $user->id }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('admin.users.resetPassword', $user) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="modal-header">
              <h5 class="modal-title" id="resetPasswordModalLabel-{{ $user->id }}">Reset Mật khẩu cho {{ $user->name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="password-{{ $user->id }}" class="form-label">Mật khẩu mới (Tối thiểu 8 ký tự)</label>
                <input type="password" class="form-control" id="password-{{ $user->id }}" name="password" required minlength="8">
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-danger">Xác nhận Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    @endforeach
@endsection