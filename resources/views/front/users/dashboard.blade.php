@extends('front.users.layouts.master')
@section('title','Kullanıcı Ayarları')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-left text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach

        </div>
        @endif
        <form action="{{ route('users.settings.update') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label>E-Mail</label>
                        <input class="form-control" type="text" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label>Şifre</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Şifre Tekrar</label>
                        <input class="form-control" type="password" name="password2">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn btn-primary btn-block">Kaydet</button>
                    </div>
                </div>

        </form>

    </div>
</div>
@endsection