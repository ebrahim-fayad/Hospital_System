<!-- Modal -->
<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('sections_trans.edit_sections')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Sections.update', $section->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="modal-body">
                   <div class="form-group mb-2">
                     <label for="exampleInputPassword1">{{trans('sections_trans.name_sections')}}</label>
                     <input type="text" name="name" value="{{ $section->name }}" class="form-control">
                   </div>
                    <div class="form-group mb-2">
                        <label for="exampleInputPassword1">{{trans('sections_trans.description')}}</label>
                        <textarea name="description" class="form-control" cols="30" rows="5">{{ $section->description }}</textarea>

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
