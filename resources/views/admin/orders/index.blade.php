@extends('admin.layouts.app')

@section('title', 'Quản lý Đơn đặt cọc')

@section('content')
<div class="container-fluid pt-4 bg-dark text-white" style="min-height: 100vh;">
    <h1 class="text-uppercase fw-bold mb-4 text-warning">Quản lý Đơn đặt cọc</h1>
    
    {{-- Thông báo --}}
    @if (session('success'))
        <div class="alert alert-success bg-dark text-white border-success"><i class="fas fa-check-circle me-2"></i> {{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger bg-dark text-white border-danger"><i class="fas fa-times-circle me-2"></i> {{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead class="text-warning">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã Đơn</th>
                    <th scope="col">Khách hàng</th>
                    <th scope="col">Xe đặt cọc</th>
                    <th scope="col">SĐT</th>
                    <th scope="col">Số tiền cọc</th>
                    <th scope="col">PTTT</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-bold">{{ $order->order_code }}</td>
                        <td>
                            <span class="fw-bold">{{ $order->user->name ?? 'N/A' }}</span> <br>
                            <small class="text-muted">{{ $order->user->email ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <a href="#" class="text-info text-decoration-none">{{ $order->car->name ?? 'N/A' }}</a>
                        </td>
                        <td>{{ $order->user_phone }}</td>
                        <td class="text-nowrap">{{ number_format($order->amount, 0, ',', '.') }} VNĐ</td>
                        <td>
                            @if ($order->payment_method == 'bank_transfer')
                                <span class="badge bg-secondary">Chuyển khoản</span>
                            @elseif ($order->payment_method == 'visa')
                                <span class="badge bg-primary">Visa/Master</span>
                            @endif
                        </td>
                        <td>
                            @if ($order->status == 'pending')
                                <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                            @elseif ($order->status == 'approved')
                                <span class="badge bg-success">Đã xác nhận</span>
                            @elseif ($order->status == 'cancelled')
                                <span class="badge bg-danger">Đã hủy</span>
                            @endif
                        </td>
                        <td class="text-nowrap">
                            @if ($order->status == 'pending')
                                {{-- Nút Duyệt --}}
                                <form action="{{ route('admin.orders.approve', $order) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success me-1" onclick="return confirm('Xác nhận Đơn hàng {{ $order->order_code }} đã thanh toán?');">
                                        Duyệt
                                    </button>
                                </form>
                                
                                {{-- Nút Hủy --}}
                                <form action="{{ route('admin.orders.cancel', $order) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận HỦY Đơn hàng {{ $order->order_code }}?');">
                                        Hủy
                                    </button>
                                </form>
                            @else
                                <span class="text-muted small">Đã xử lý</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">Chưa có đơn đặt cọc nào được tạo.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection