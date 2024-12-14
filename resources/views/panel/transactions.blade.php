@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>مدیریت تراکنش‌ها</h1>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
            </tr>
            @empty
            <tr>
                <td colspan="6">تراکنشی در انتظار تایید وجود ندارد.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="mt-5">تراکنش‌های تکمیل‌شده</h3>
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
            </tr>
        </thead>
        <tbody>
            @forelse ($approvedTransactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->senderWallet->sheba }}</td>
                <td>{{ $transaction->senderWallet->user->name }}</td>
                <td>{{ $transaction->receiverWallet->sheba }}</td>
                <td>{{ $transaction->receiverWallet->user->name }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">هیچ تراکنش تکمیل‌شده‌ای وجود ندارد.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h3 class="mt-5">تراکنش‌های رد شده</h3>
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
            </tr>
        </thead>
        <tbody>
            @forelse ($rejectedTransactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->senderWallet->sheba }}</td>
                <td>{{ $transaction->senderWallet->user->name }}</td>
                <td>{{ $transaction->receiverWallet->sheba }}</td>
                <td>{{ $transaction->receiverWallet->user->name }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">هیچ تراکنش رد شده ای وجود ندارد.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
