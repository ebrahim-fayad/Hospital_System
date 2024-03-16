<div class="main-chat-list" wire:ignore.self id="ChatList">
    @foreach ($conversations as $conversation)
        <div class="media border-bottom-0"
            wire:click="test({{ $conversation }},{{ Auth::guard('patient')->check() ? $this->getDoctorName($conversation, 'id') : $this->getPatientName($conversation, 'id') }})">
            <div class="main-img-user"><img alt="" src="{{ asset('Dashboard/img/faces/6.jpg') }}"></div>
            <div class="media-body">
                <div class="media-contact-name">
                    @if (Auth::guard('patient')->check())
                        <span>{{ $this->getDoctorName($conversation, 'name') }}</span>
                    @else
                        <span>{{ $this->getPatientName($conversation, 'name') }}</span>
                    @endif
                    {{--  <span>{{$this->getUsers($conversation,$name='name')}}</span>  --}}
                    {{--  <span>{{ $conversation->messages->last()->created_at->shortAbsoluteDiffForHumans() }}</span>  --}}
                    <span>{{ $conversation->messages->last()->created_at->diffForHumans() }}</span>
                </div>
                <p>{{ $conversation->Messages->last()->body }}</p>

            </div>

        </div><!-- end  media new-->
    @endforeach
</div><!-- main-chat-list -->
