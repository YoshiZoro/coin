@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="mb-4">خوش آمدید، {{ $user->name }}</h1>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>کیف پول‌ شما</h3>
            <ul class="list-group">
                @if ($wallet)
                <li class="list-group-item">
                    <strong>شماره شبا:</strong> {{ $wallet->sheba }}<br>
                    <strong>موجودی:</strong> {{ $wallet->balance }} سکه
                    <div class="col-md-12 text-center">
                        <a href="{{route('transaction.create')}}" class="btn btn-success">انتقال سکه</a>
                    </div>
                </li>
                @else
                <li class="list-group-item">شما هنوز کیف پولی ندارید.
                    <div class="col-md-12 text-center">
                        <a href="{{route('wallet.create')}}" class="btn btn-primary">ایجاد کیف پول</a>
                    </div>
                </li>
                @endif
            </ul>
        </div>

        <div class="col-md-6">
            <h3>تراکنش‌های اخیر</h3>
            <ul class="list-group">
                @forelse ($transactions as $transaction)
                <li class="list-group-item">
                    <strong>نوع:</strong> {{ $transaction->type }}<br>
                    <strong>مبلغ:</strong> {{ $transaction->amount }} سکه<br>
                    <strong>کاربر مرتبط:</strong> {{ $transaction->related_user->name ?? 'نامشخص' }}<br>
                    <strong>وضعیت:</strong> {{ $transaction->status }} <br>
                    <strong>تاریخ:</strong> {{ $transaction->created_at }}
                </li>
                @if($loop->last)
                <div class="col-md-12 text-center mt-2">
                    <a href="{{route('transactions.index')}}" class="btn btn-info">تاریخچه تمامی تراکنش ها</a>
                </div>
                @endif
                @empty
                <li class="list-group-item">شما هنوز تراکنشی انجام نداده‌اید.</li>
                @endforelse

            </ul>
        </div>
    </div>

    <div class="row mt-4">

    </div>
</div>
@endsection
