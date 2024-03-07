<!-- Modal -->
<div class="modal fade" id="edit{{ $laboratory_employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات موظف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Laboratory_Employee.update', $laboratory_employee->id) }}" enctype="multipart/form-data"
                method="post">
                @method('PUT')
                @csrf
                @csrf
                <div class="modal-body">

                    <br><br>
                    <div class="row align-items-center justify-center mg-b-20 ">
                        <div class="col-md-4">
                             <div>
                        @if ($laboratory_employee->image)
                            <img style="border-radius:20%"
                                src="{{ asset('Dashboard/img/' . $laboratory_employee->image->fileName) }}" height="100%"
                                width="100%" alt="">
                        @else
                            <img style="border-radius:50%" src="{{ asset('Dashboard/img/laboratory_employee.jpg') }}"
                                height="50px" width="50px" alt="">
                        @endif
                    </div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">الاسم</label>
                    <input type="text" name="name" value="{{ $laboratory_employee->name }}" class="form-control"><br>
                        </div>
                    </div>

                    <div class="row row-sm">
                        <div class="col-sm-6">
                            <label for="exampleInputPassword1">البريد الالكتروني</label>
                            <input type="email" value="{{ $laboratory_employee->email }}" name="email"
                                class="form-control"><br>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputPassword1">كلمة المرور</label>
                            <input type="password" name="password" class="form-control"><br>
                        </div>
                    </div>
                    <div class="card p-3 ">

                        <div class="row row-xs align-items-center justify-center mg-b-20 mt-3">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    {{ trans('Doctors.doctor_photo') }}</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                <img style="border-radius:50%" width="150px" height="150px" id="output" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('sections_trans.Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('sections_trans.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
