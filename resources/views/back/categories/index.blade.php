@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('css')
<link href="{{ asset('back/') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                <form action="{!! route('admin.category.create') !!}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input type="text" name="category" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durumu</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->articleCount() }}</td>
                                <td>
                                    <input class="switch" category-id="{{ $category->id }}" type="checkbox" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" @if($category->status==1) checked
                                    @endif data-toggle="toggle" data-onstyle="primary">
                                </td>
                                <td>
                                    <a href="{{ route('category',$category->slug) }}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    <a category-id="{{ $category->id }}" title="Düzenle" class="btn btn-sm btn-primary text-white edit-click"><i class="fa fa-pen"></i></a>
                                    <a category-name="{{ $category->name }}" category-id="{{ $category->id }}" category-count="{{ $category->articleCount() }}" title="Düzenle" class="btn btn-sm btn-danger text-white remove-click"><i class="fa fa-times"></i></a>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Katagoriyi Düzenle</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('admin.category.update') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input id="category" type="text" name="category" value="" class="form-control">
                        <input type="hidden" name="id" id="category_id" />
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Katagoriyi Sil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="body" class="modal-body">
              <div  class="alert alert-danger" id="articleAlert">

              </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                <form  action="{{ route('admin.category.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="delete_id" value="">
                    <button id="deleteButton" type="submit" class="btn btn-success">Sil</button>
                </form>
            </div>

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
        $('.remove-click').click(function() {
          id = $(this)[0].getAttribute('category-id');
          count = $(this)[0].getAttribute('category-count');
          name = $(this)[0].getAttribute('category-name');
          if(id==1){
              $('#body').show();
              $('#articleAlert').html(name + ' kategorisi sabit kategoridir. Silinen diğer kategorilere ait makaleler bu kategoriye eklenecektir.');
              $('#deleteButton').hide();
              $('#deleteModal').modal();
              return;
          }
          $('#deleteButton').show();
          $('#delete_id').val(id);
          $('#articleAlert').html('');
          $('#body').hide();
          if(count>0){
            $('#body').show();
            $('#articleAlert').html('Bu kategoriye ait ' + count + ' makale bulunmaktadır. Silmek istediğinize emin misiniz ?');
          }
          $('#deleteModal').modal();
        });
        $('.edit-click').click(function() {
            id = $(this)[0].getAttribute('category-id');
            $.ajax({
                type: 'GET',
                url: '{{ route('admin.category.getData') }}',
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    $('#category').val(data.name);
                    $('#category_id').val(data.id);
                    $('#editModal').modal();
                }
            })
        });

        $('.switch').change(function() {
            id = $(this)[0].getAttribute('category-id');
            $.get("{{  route('admin.category.switch') }}", {
                id: id
            });
        })
    })
</script>
@endsection
