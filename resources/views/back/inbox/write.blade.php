@php
$inboxCenter = App\Models\Inbox::where('status', 0)->orderBy('id', 'ASC')->get()
@endphp
@extends('back.layouts.master')
@section('title','Yeni Mesaj')
@section('css')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('Back/inbox/') }}/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('Back/inbox/') }}/bower_components/Ionicons/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('Back/inbox/') }}/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('Back/inbox/') }}/dist/css/skins/_all-skins.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('Back/inbox/') }}/plugins/iCheck/flat/blue.css">
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box-body no-padding ">
                <a class="form-control text-primary" href="{{ route('admin.inbox.write') }}"><i class="fa fa-pencil"></i> Mesaj Gönder</a>
                <a class="form-control" href="{{ route('admin.inbox.index') }}">
                    <i class="fa fa-inbox"></i> Gelen Kutusu <span class="text-bold pull-right">
                        @if($inboxCenter->count()>0){{ $inboxCenter->count() }}
                            @endif
                    </span>
                </a>
                <a class="form-control" href="{{ route('admin.inbox.sentedAll') }}"><i class="fa fa-envelope-o"></i> Gönderilenler</a>
                <a class="form-control" href="{{ route('admin.inbox.trashed') }}"><i class="fa fa-trash-o"></i> Çöp Kutusu </a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Yeni Mesaj</h3>
                </div>

                <form class="" action="{{ route('admin.inbox.writePost') }}" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <input class="form-control" name="email" value="{{ $emails }}" placeholder="Kime:">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="subject" placeholder="Konu:">
                        </div>
                        <div class="form-group">
                            <textarea rows="10 " name="contect" id="content" class="form-control" placeholder="İçerik:"></textarea>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Gönder</button>
                        </div>
                    </div>
                </form>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.row -->
</section>
@endsection