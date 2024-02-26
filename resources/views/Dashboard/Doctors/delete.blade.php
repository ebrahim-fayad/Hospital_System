<!-- Modal -->
<div class="modal fade" id="delete{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Doctors.delete_doctor') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Doctors.destroy',$doctor->id) }}" method="post">
               @method('DELETE')
               @csrf
                <div class="modal-body">
                    <h5>{{trans('sections_trans.Warning')}}</h5>
                    <input type="hidden" value="1" name="page_id">
                    @if($doctor->image)
                        <input type="hidden" name="fileName" value="{{$doctor->image->fileName}}">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
