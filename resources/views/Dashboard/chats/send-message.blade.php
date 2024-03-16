<div style="margin-top: -4px">
    @if ($selected_conversation)

    <form class="container">
        <div class="main-chat-footer">
            <input class="form-control" wire:model='body' placeholder="Type your message here..." type="text">
            <a class="main-msg-send" wire:click.prevent='createMessage'  href="#"><i class="far fa-paper-plane"></i></a>
        </div>
        @error('body')
        <div class="text-danger text-center p-3">{{ $message }}</ي>
            @enderror
        </form>
        @endif
</div>
