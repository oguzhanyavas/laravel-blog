@php
$inboxCenter = App\Models\Inbox::where('status', 0)->orderBy('id', 'ASC')->get()
@endphp
@extends('back.layouts.master')
@section('title','Gönderilenler Kutusu')
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
            <div class="box-body no-padding">
                <a class="form-control" href="{{ route('admin.inbox.write') }}"><i class="fa fa-pencil"></i> Mesaj Gönder</a>
                <a class="form-control" href="{{ route('admin.inbox.index') }}">
                    <i class="fa fa-inbox"></i>Gönderilenler Kutusu<span class="text-bold pull-right">
                        @if($inboxCenter->count()>0){{ $inboxCenter->count() }}
                            @endif
                    </span>
                </a>
                <a class="form-control  text-primary" href="#"><i class="fa fa-envelope-o"></i> Gönderilenler</a>
                <a class="form-control" href="{{ route('admin.inbox.trashed') }}"><i class="fa fa-trash-o"></i> Çöp Kutusu </a>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Gönderilenler Kutusu</h3>

                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <form class="" action="{{ route('admin.replyMulti') }}" method="post">
                        @csrf
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                            </button>
                            <div class="btn-group">
                                <button formaction="{{ route('admin.trashMulti') }}" type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                            </div>
                            <!-- /.btn-group -->
                            <div class="pull-right">
                                1-50/200
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    @foreach ($inboxes as $inbox)
                                    @if (auth()->user()->email == $inbox->sEmail)


                                    <tr>
                                        <td><input name="InboxId[]" type="checkbox" value="{{ $inbox->id }}"></td>
                                        <td class="mailbox-star"><a href="#"></a></td>
                                        <td class="mailbox-name"><a class="@if($inbox->status == 0) text-primary @else text-muted @endif" href="{{ route('admin.inbox.sendershow',$inbox->id) }}">{{ $inbox->name }}</a></td>
                                        <td class="mailbox-subject"><b>{{ $inbox->topic }}</b> - {{ Str::limit($inbox->message,80) }}
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">{{ $inbox->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection
@section('js')
<script src="{{ asset('Back/inbox/') }}/bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('Back/inbox/') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('Back/inbox/') }}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('Back/inbox/') }}/dist/js/adminlte.min.js"></script>
<!-- iCheck -->
<script src="{{ asset('Back/inbox/') }}/plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script>
    $(function() {
        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function() {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function(e) {
            e.preventDefault();
            //detect type
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");

            //Switch states
            if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
            }

            if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
            }
        });
    });
</script>
@endsection