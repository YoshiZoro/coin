@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>مدیریت کاربران</h1>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a class="btn btn-primary btn-info" href="{{route('admin.index')}}">بازگشت</a>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>شناسه</th>
                <th>نام</th>
                <th>ایمیل</th>
                <th>نقش</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" class="d-inline">
                        @csrf
                        <select name="role" onchange="this.form.submit()">
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>کاربر</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>مدیر</option>
                        </select>
                    </form>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
