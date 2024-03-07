<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة موظف مختبر جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Laboratory_Employee.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">الاسم</label>
                    <input type="text" name="name" class="form-control"><br>
                    <div class="row row-sm">
                        <div class="col-sm-6">
                            <label for="exampleInputPassword1">البريد الالكتروني</label>
                            <input type="email" name="email" class="form-control"><br>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputPassword1">كلمة المرور</label>
                            <input type="password" name="password" class="form-control"><br>
                        </div>
                    </div>
                    <div class="card p-3 ">

                          <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-1">
                                <label for="exampleInputEmail1">
                                    {{ trans('Doctors.doctor_photo') }}</label>
                            </div>
                            <div class="col-md-11 mg-t-5 mg-md-t-0">
                                <input type="file" accept="image/*" name="photo" onchange="loadFiled(event)">
                                <img style="border-radius:50%" width="150px" height="150px" id="outputed" />
                            </div>
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
