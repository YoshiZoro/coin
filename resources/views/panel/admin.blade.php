@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">پنل مدیریت</h1>

    <div class="row mt-4">
        <!-- اطلاعات کلی -->
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">کاربران</h5>
                    <p class="card-text">{{ $userCount }} کاربر</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">مدیریت کاربران</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">کیف پول‌ها</h5>
                    <p class="card-text">{{ $walletCount }} کیف پول</p>
                    <a href="{{ route('admin.wallets.index') }}" class="btn btn-primary btn-sm">مدیریت کیف پول‌ها</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">تراکنش‌ها</h5>
                    <p class="card-text">{{ $transactionCount }} تراکنش</p>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary btn-sm">مدیریت تراکنش‌ها</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">تراکنش‌های در انتظار</h5>
                    <p class="card-text">{{ $pendingTransactionCount }} تراکنش</p>
                    <a href="{{ route('pending.transactions.index') }}" class="btn btn-warning btn-sm">بررسی تراکنش‌ها</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <!-- گزارش‌های اخیر -->
        <div class="col-md-12">
            <h3>تراکنش‌های اخیر در انتظار تأیید</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>شماره شبا مبدأ</th>
                        <th>شماره شبا مقصد</th>
                        <th>مبلغ</th>
                        <th>تاریخ</th>
                        <th>وضعیت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentPendingTransactions as $transaction)
                    <tr>

                        <td>{{ $transaction->senderWallet->sheba }}</td>
                        <td>{{ $transaction->receiverWallet->sheba }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td><span class="badge bg-warning">در انتظار</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
