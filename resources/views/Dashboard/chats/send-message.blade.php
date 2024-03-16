<div style="margin-top: -4px">
    @if ($selected_conversation)

    <form class="container" wire:submit.prevent='createMessage'>
        <div class="main-chat-footer">
            <input class="form-control" wire:model='body' placeholder="Type your message here..." type="text">
            <button type="submit" class="btn main-msg-send"   href="#"><i class="far fa-paper-plane"></i></لا>
        </div>
        @error('body')
        <div class="text-danger text-center p-3">{{ $message }}</ي>
            @enderror
        </form>
        @endif
</div>
