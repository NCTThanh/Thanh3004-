@extends('admin.layouts.app')

@section('title', 'Quản lý Liên hệ')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Danh sách Yêu cầu Liên hệ</h4>
    </div>

    {{-- PHẦN HIỂN THỊ THÔNG BÁO --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    {{-- PHẦN NỘI DUNG CHÍNH (BẢNG) --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Khách hàng</th>
                        <th>Email</th>
                        <th>Chủ đề</th>
                        <th>Nội dung</th>
                        <th>Ngày gửi</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submissions as $submission)
                        <tr>
                            <td>{{ $submission->id }}</td>
                            <td>{{ $submission->name }}</td>
                            <td>{{ $submission->email }}</td>
                            <td>{{ $submission->subject }}</td>
                            <td>{{ Str::limit($submission->message, 40) }}</td>
                            <td>{{ $submission->created_at->format('H:i d-m-Y') }}</td>
                            <td>
                                {{-- Nút Xem chi tiết/Trả lời (dùng Modal) --}}
                                <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#replyModal-{{ $submission->id }}">
                                    Xem/Trả lời
                                </button>
                                
                                {{-- Nút Xóa --}}
                                <form action="{{ route('admin.contacts.destroy', $submission->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Bạn có chắc muốn xóa yêu cầu liên hệ này?')">
                                        Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Chưa có yêu cầu liên hệ nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $submissions->links() }}
        </div>
    </div>

    {{-- MODAL Xem/Trả lời Email (Giữ nguyên) --}}
    @foreach($submissions as $submission)
    <div class="modal fade" id="replyModal-{{ $submission->id }}" tabindex="-1" aria-labelledby="replyModalLabel-{{ $submission->id }}" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.contacts.reply', $submission->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel-{{ $submission->id }}">Trả lời: {{ $submission->subject }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>📩 Thông tin Khách hàng</h6>
                    <p class="mb-1"><strong>Tên:</strong> {{ $submission->name }}</p>
                    <p class="mb-3"><strong>Email:</strong> <span class="text-danger">{{ $submission->email }}</span></p>
                    
                    <hr>
                    
                    <h6>📝 Nội dung Yêu cầu</h6>
                    <p class="alert alert-secondary">{{ $submission->message }}</p>

                    <div class="mb-3">
                        <label for="reply-message-{{ $submission->id }}" class="form-label">Nội dung Phản hồi của bạn</label>
                        <textarea class="form-control" id="reply-message-{{ $submission->id }}" name="message" rows="5" required></textarea>
                        @error('message')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Gửi Phản hồi Email</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    @endforeach
@endsection