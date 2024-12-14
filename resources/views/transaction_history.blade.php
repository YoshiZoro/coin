@extends('layouts.app')

@section('title', 'تاریخچه تراکنش‌ها')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="mb-4"> تاریخچه تمامی تراکنش‌ها (دریافتی و ارسالی)</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>فرستنده</th>
                        <th>گیرنده</th>
                        <th>مبلغ (سکه)</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->senderWallet->user->name ?? 'نامشخص' }}</td>
                            <td>{{ $transaction->receiverWallet->user->name ?? 'نامشخص' }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>
                                @if ($transaction->status === 'pending')
                                    <span class="badge bg-warning">در انتظار تأیید</span>
                                @elseif ($transaction->status === 'approved')
                                    <span class="badge bg-success">موفق</span>
                                @elseif ($transaction->status === 'rejected')
                                    <span class="badge bg-danger">رد شده</span>
                                @endif
                            </td>
                            <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">هیچ تراکنشی یافت نشد.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
