@extends('back.layouts.master')
@section('title','Makaleler')
@section('css')
<link href="{{ asset('back/') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-left text-primary">@yield('title')</h6>
        <h6 class="m-0 font-weight-bold float-right text-primary"><strong> {{ $articles->count() }} makale bulundu. </strong>
            <a href="{{ route('admin.trashed.article') }}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Makaleler</a>
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
                        <th>Status</th>
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
                        <td>{{ $article->created_at }}</td>
                        <td>
                            <input class="switch" article-id="{{ $article->id }}" type="checkbox" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" @if($article->status==1) checked
                            @endif data-toggle="toggle" data-onstyle="primary">
                        </td>
                        <td>
                            <a href="{{ route('single',[$article->getCategory->slug,$article->slug]) }}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.makaleler.edit',$article->id) }}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{ route('admin.makaleler.delete',$article->id) }}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>

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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function() {
        $('.switch').change(function() {
            id = $(this)[0].getAttribute('article-id');
            $.get("{{  route('admin.switch') }}", {
                id: id
            });
        })
    })
</script>
@endsection
