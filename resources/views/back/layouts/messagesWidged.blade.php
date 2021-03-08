@php
$inboxCenter = App\Models\Inbox::where('status', 0)->orderBy('id', 'ASC')->get()
@endphp
<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-envelope fa-fw"></i>
    @if($inboxCenter->count()>0)<span class="badge badge-danger badge-counter">{{ $inboxCenter->count() }}</span></span>
        @endif
</a>
<!-- Dropdown - Messages -->
<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
    <h6 class="dropdown-header">
        Mesaj Merkezi
    </h6>

    @foreach ($inboxCenter as $inbox)
    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.inbox.show',$inbox->id) }}">
        <div class="font-weight-bold">
            <div class="text-truncate">{{ Str::limit($inbox->message,60) }}</div>
            <div class="small text-gray-500">{{ $inbox->name }} · {{ $inbox->created_at->diffForHumans() }}</div>
        </div>
    </a>
    @endforeach

    <a class="dropdown-item text-center small text-gray-500" href="{{ route('admin.inbox.index') }}">Tüm Mesajlar</a>
</div>