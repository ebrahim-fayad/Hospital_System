<!-- Modal -->
<div class="modal fade" id="update_password{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Doctors.update_password') }} {{$doctor->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Doctors.update_password', $doctor->id) }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">{{ trans('Doctors.new_password') }}</label>
                        <input type="password" class="form-control" id="password" name="password" >
                        @error('password')
                        @include('Dashboard.sweet_alert',['error_name'=>'password'])
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{ trans('doctors.confirm_password') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        @include('Dashboard.sweet_alert',['error_name'=>'password_confirmation'])
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
