@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>مدیریت تراکنش‌ها</h1>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a class="btn btn-primary btn-info" href="{{route('admin.index')}}">بازگشت</a>
    <h3>تراکنش‌های در انتظار تایید</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>شماره تراکنش</th>
                <th>فرستنده</th>
                <th>نام فرستنده</th>
                <th>گیرنده</th>
                <th>نام گیرنده</th>
                <th>مبلغ</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendingTransactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->senderWallet->sheba }}</td>
                <td>{{ $transaction->senderWallet->user->name }}</td>
                <td>{{ $transaction->receiverWallet->sheba }}</td>
                <td>{{ $transaction->receiverWallet->user->name }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->status }}</td>
                <td>
                    <form action="{{ route('pending.transactions.approve', $transaction) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">تایید</button>
                    </form>
                    <form action="{{ route('pending.transactions.reject', $transaction) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">رد</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">تراکنشی در انتظار تایید وجود ندارد.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
