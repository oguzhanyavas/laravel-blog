@extends('back.layouts.master')
@section('title','Silinen Makaleler')
@section('css')
<link href="{{ asset('back/') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-left text-primary">@yield('title')</h6>
        <h6 class="m-0 font-weight-bold float-right text-primary"><strong> {{ $articles->count() }} makale bulundu. </strong>
            <a href="{{ route('admin.makaleler.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-home"></i> Tüm Makaleler</a>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlık</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>
                            <img width="200" height="100" src='{{ asset($article->image) }}'>
                        </td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->getCategory->name }}</td>
                        <td>{{ $article->hit }}</td>
                        <td>{{ $article->created_at->diffForHumans() }}</td>

                        <td>
                            <a href="{{ route('admin.makaleler.recover',$article->id) }}" title="Kurtar" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                            <a href="{{ route('admin.makaleler.forcedelete',$article->id) }}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{  asset('back/') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{  asset('back/') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{  asset('back/') }}/js/demo/datatables-demo.js"></script>

@endsection