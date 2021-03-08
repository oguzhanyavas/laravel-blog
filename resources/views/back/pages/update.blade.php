@extends('back.layouts.master')
@section('title',$page->title. ' Sayfasını Güncelle')
    @section('css')
    <link href="{{ asset('back/') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
    @endsection
    @section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-left text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="post" action="{{ route('admin.page.updatePost',$page->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Sayfa Başlığı</label>
                    <input type="text" name="title" value="{{ $page->title }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Sayfa Fotoğrafı </label><br>
                    <img class="img-thumbnail rounded" src="{{ asset($page->image) }}" width="400" height="200"><br><br>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label>Sayfa İçeriği</label>
                    <textarea id="summernote" name="content" class="form-control">{!! $page->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">İçeriği Güncelle</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    @endsection
    @section('js')
    <script src="{{  asset('back/') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{  asset('back/') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{  asset('back/') }}/js/demo/datatables-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Bir İçerik Yazmaya Başlayın !',
                height: 200
            });
        });
    </script>

    @endsection