@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">ایجاد کیف پول</div>

                <div class="card-body">
                    <!-- پیام‌های موفقیت و خطا -->
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
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

                    <!-- فرم ایجاد کیف پول -->
                    <form method="POST" action="{{ route('wallet.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="sheba" class="form-label">شماره شبا</label>
                            <input type="text" name="sheba" id="sheba"
                                   class="form-control @error('sheba') is-invalid @enderror"
                                   value="{{ 'SA'.old('sheba') }}">
                            @error('sheba')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="initialBalance" class="form-label">موجودی اولیه</label>
                            <input type="text" name="balance" id="initialBalance"
                                   class="form-control @error('balance') is-invalid @enderror"
                                   value="{{ old('balance') }}" >
                            @error('balance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">ایجاد کیف پول</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
