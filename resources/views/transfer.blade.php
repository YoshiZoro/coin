@extends('layouts.app')

@section('title', 'انتقال سکه')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">فرم انتقال سکه</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('transaction.store') }}">
                            @csrf

                            <!-- شماره شبا مبدأ -->
                            <div class="mb-3">
                                <label for="from_sheba" class="form-label">شماره شبا مبدأ:</label>
                                <input type="text" id="from_sheba" class="form-control"
                                       value="{{ $wallet->sheba }}" readonly>

                                <input type="hidden" name="from_sheba" value="{{ $wallet->sheba }}">
                            </div>

                            <!-- شماره شبا مقصد -->
                            <div class="mb-3">
                                <label for="to_sheba" class="form-label">شماره شبا مقصد:</label>
                                <input type="text" name="to_sheba" id="to_sheba"
                                       class="form-control @error('to_sheba') is-invalid @enderror"
                                       value="{{ old('to_sheba') }}">

                                @error('to_sheba')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- مبلغ تراکنش -->
                            <div class="mb-3">
                                <label for="amount" class="form-label">مبلغ انتقال:</label>
                                <input type="text" name="amount" id="amount"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       value="{{ old('amount') }}">

                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- دکمه ارسال -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">ارسال درخواست انتقال</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
