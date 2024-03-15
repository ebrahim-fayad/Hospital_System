<div class="main-chat-list" id="ChatList">
    @foreach ($conversations as $conversation)
        <div class="media border-bottom-0">
            <div class="main-img-user"><img alt="" src="{{ asset('Dashboard/img/faces/6.jpg') }}"></div>
            <div class="media-body">
                <div class="media-contact-name">
                    @if (Auth::guard('patient')->check())
                    <span>{{ $this->getDoctorName($conversation) }}</span>
                    @else
                    <span>{{ $this->getPatientName($conversation) }}</span>
                    @endif
                    {{--  <span>{{$this->getUsers($conversation,$name='name')}}</span>  --}}
                    {{--  <span>{{ $conversation->messages->last()->created_at->shortAbsoluteDiffForHumans() }}</span>  --}}
                    <span>{{$conversation->messages->last()->created_at->diffForHumans()}}</span>
                </div>
                <p>{{ $conversation->Messages->last()->body }}</p>

            </div>

        </div><!-- end  media new-->
    @endforeach
</div><!-- main-chat-list -->
