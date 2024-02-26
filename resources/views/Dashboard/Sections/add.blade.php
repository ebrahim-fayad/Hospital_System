<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('sections_trans.add_sections') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Sections.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="exampleInputPassword1">{{ trans('sections_trans.name_sections') }}</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                            <script>
                                window.onload = function() {

                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "{{ $message }}",
                                        footer: '<a href="#">Why do I have this issue?</a>'
                                    });
                                };
                            </script>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label
                            for="exampleInputPassword1">{{ trans('sections_trans.description') }}</label>
                        <textarea name="description" class="form-control" cols="30" rows="5"
                            placeholder="{{ trans('sections_trans.description') }}"></textarea>

                        @error('description')
                            <script>
                                window.onload = function() {

                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "{{ $message }}",
                                        footer: '<a href="#">Why do I have this issue?</a>'
                                    });
                                };
                            </script>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('sections_trans.Close') }}</button>
                    <button type="submit"
                        class="btn btn-primary">{{ trans('sections_trans.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
