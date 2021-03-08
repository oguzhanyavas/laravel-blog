@extends('back.layouts.master')
@section('title','Sayfalar')
@section('css')
<link href="{{ asset('back/') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold float-left text-primary">@yield('title')</h6>
        <h6 class="m-0 font-weight-bold float-right text-primary"><strong> {{ $pages->count() }} sayfa bulundu. </strong>
        </h6>
    </div>
    <div class="card-body">
        <div id="orderSuccess" style="display:none" class="alert alert-success">
            Sıralama başarıyla güncellendi.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlık</th>
                        <th>Status</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody id='orders'>
                    @foreach ($pages as $page)
                    <tr id='page_{{ $page->id }}'>
                        <td class="text-center" style="width:3%;height:3%"><i class="fa fa-arrows-alt-v fa-3x handle" style="cursor:move"></i></td>
                        <td>
                            <img width="200" height="100" src='{{ asset($page->image) }}'>
                        </td>
                        <td>{{ $page->title }}</td>
                        <td>
                            <input class="switch" page-id="{{ $page->id }}" type="checkbox" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" @if($page->status==1) checked
                            @endif data-toggle="toggle" data-onstyle="primary">
                        </td>
                        <td>
                            <a href="{{ route('page',$page->slug) }}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.page.update',$page->id) }}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{ route('admin.page.delete',$page->id) }}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>

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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.js"></script>
<script>
    $('#orders').sortable({
        handle: '.handle',
        update: function() {
            var siralama = $('#orders').sortable('serialize');
            $.get("{{  route('admin.page.orders') }}?" + siralama, function(data, status) {
                $("#orderSuccess").show().delay(2000).fadeOut();
            });
        }
    });
</script>
<script>
    $(function() {
        $('.switch').change(function() {
            id = $(this)[0].getAttribute('page-id');
            $.get("{{  route('admin.page.switch') }}", {
                id: id
            });
        })
    })
</script>
@endsection