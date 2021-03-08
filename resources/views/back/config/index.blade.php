@extends('back.layouts.master')
@section('title','Ayarlar')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-left text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.config.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Başlığı</label>
                        <input class="form-control" type="text" name="title" value="{{ $configs->title }}">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Aktiflik Durumu</label>
                        <select class="form-control" name="status">
                            <option @if($configs->status == 1) selected
                                @endif value="1" >Açık</option>
                            <option @if($configs->status == 0) selected
                                @endif value="0" >Kapalı
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Logo</label>
                        <input class="form-control" type="file" name="logo">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Favicon</label>
                        <input class="form-control" type="file" name="favicon">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>facebook</label>
                        <input class="form-control" type="text" name="facebook" value="{{ $configs->facebook }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Twitter</label>
                        <input class="form-control" type="text" name="twitter" value="{{ $configs->twitter }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Github</label>
                        <input class="form-control" type="text" name="github" value="{{ $configs->github }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Linkedin</label>
                        <input class="form-control" type="text" name="linkedin" value="{{ $configs->linkedin }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Youtube</label>
                        <input class="form-control" type="text" name="youtube" value="{{ $configs->youtube }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Instagram</label>
                        <input class="form-control" type="text" name="instagram" value="{{ $configs->instagram }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-md btn-success">Güncelle</button>
            </div>
        </form>

    </div>
</div>
@endsection