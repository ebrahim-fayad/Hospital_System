<div>
    @if ($selected_conversation)
        <div class="main-content-body main-content-body-chat">
            <div class="main-chat-header">
                <div class="main-img-user">
                    @if ($user->image)
                        <img alt="" src="{{ asset('Dashboard/img/' . $user->image->fileName) }}">
                </div>
            @else
            @if (Auth::guard('doctor')->check())
            <img alt="" src="{{ asset('Dashboard/img/patient.png') }}">
            @else
            <img alt="" src="{{ asset('Dashboard/img/doctor_default.png') }}">
            @endif
            </div>
    @endif
    <div class="main-chat-msg-name">
        <h6>{{ $user->name }} </h6><small>Last seen: 2 minutes ago</small>
    </div>
    <nav class="nav">
        <a class="nav-link" href=""><i class="icon ion-md-more"></i></a> <a class="nav-link" data-toggle="tooltip"
            href="" title="Call"><i class="icon ion-ios-call"></i></a> <a class="nav-link"
            data-toggle="tooltip" href="" title="Archive"><i class="icon ion-ios-filing"></i></a> <a
            class="nav-link" data-toggle="tooltip" href="" title="Trash"><i class="icon ion-md-trash"></i></a>
        <a class="nav-link" data-toggle="tooltip" href="" title="View Info"><i
                class="icon ion-md-information-circle"></i></a>
    </nav>
</div><!-- main-chat-header -->
<div class="main-chat-body" id="ChatBody">
    <div class="content-inner">
        <label class="main-chat-time"><span>3 days ago</span></label>
        @forelse ($messages as $message)
            <div class="media {{ auth()->user()->email == $message->sender_email ?'flex-row-reverse' :" " }} ">
                <div class="main-img-user online"><img alt="" src="{{ asset('Dashboard/img/faces/9.jpg') }}">
                </div>
                <div class="media-body">
                    <div class="main-msg-wrapper right">
                        {{ $message->body }}
                    </div>

                    <div>
                        {{--  <span>{{ $message->created_at->diffForHumans() }}</span>  --}}
                        <span> <?php echo \Carbon\Carbon::parse($message->created_at)->format('g:i'); ?> </span>
                        <a href=""><i class="icon ion-android-more-horizontal"></i></a>
                    </div>
                </div>
            </div>
        @empty
            <span class="test-danger">no messages yet</span>
        @endforelse


    </div>
</div>
</div>
@endif

</div>
