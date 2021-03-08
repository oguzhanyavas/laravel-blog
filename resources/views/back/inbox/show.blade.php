@extends('back.layouts.master')
@section('title','Mesaj')
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
                <a class="form-control" href="{{ route('admin.inbox.write') }}"><i class="fa fa-pencil"></i> Mesaj Gönder</a>
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
                    <h3 class="box-title">Mesaj</h3>


                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3>{{ $inboxes->topic }}</h3>
                        <h5>Göderen E-Mail: {{ $inboxes->sEmail }}
                            <span class="mailbox-read-time pull-right">{{ $inboxes->created_at }} {{ $inboxes->created_at->diffForHumans(null, false, true) }}</span></h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-center">
                        <div class="btn-group">
                            <form class="" action="{{ route('admin.inbox.destroy',$inboxes->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                                    <i class="fa fa-trash-o"></i></button>
                            </form>
                            <form class="" action="{{ route('admin.inbox.reply',$inboxes->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply"><i class="fa fa-reply"></i></button>
                            </form>

                        </div>

                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        {{ $inboxes->message }}
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>

                <!-- /.box-footer -->
                <div class="box-footer">
                    <div class="pull-right">
                        <form class="" action="{{ route('admin.inbox.reply',$inboxes->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                        </form>
                    </div>
                    <div class="pull-right">
                        <form class="" action="{{ route('admin.inbox.destroy',$inboxes->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                        </form>
                    </div>

                </div>
                <!-- /.box-footer -->
            </div>
        </div>
        <!-- /.row -->
</section>
@endsection