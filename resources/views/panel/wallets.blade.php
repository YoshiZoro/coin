@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>مدیریت کیف پول‌ها</h1>


    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>شماره شبا</th>
                <th>موجودی</th>
                <th>کاربر</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wallets as $wallet)
                <tr>
                    <td>{{ $wallet->sheba }}</td>
                    <td>{{ $wallet->balance }} سکه</td>
                    <td>{{ $wallet->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
