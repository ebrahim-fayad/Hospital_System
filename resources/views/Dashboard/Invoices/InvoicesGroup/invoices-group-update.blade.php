<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    اضافة فاتورة خدمة مفردة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="store" autocomplete="off">
                @csrf

                <div class="col">
                    <label>اسم المريض</label>
                    <select wire:model.live="patient_id" class="form-control">
                        <option value="">-- اختار من القائمة --</option>
                        @foreach ($Patients as $Patient)
                            <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col">
                    <label>اسم الدكتور</label>
                    <select wire:model.live="doctor_id" wire:change="get_section" class="form-control"
                        id="exampleFormControlSelect1">
                        <option value="">-- اختار من القائمة --</option>
                        @foreach ($Doctors as $Doctor)
                            <option value="{{ $Doctor->id }}">{{ $Doctor->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col">
                    <label>القسم</label>
                    <input wire:model.live="section_id" type="text" class="form-control" readonly>
                </div>

                <div class="col">
                    <label>نوع الفاتورة</label>
                    <select wire:model.live="type" class="form-control">
                        <option value="">-- اختار من القائمة --</option>
                        <option value="1">نقدي</option>
                        <option value="2">اجل</option>
                    </select>
                </div> <br>




                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0"></h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mg-b-0 text-md-nowrap" style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم الخدمة</th>
                                                <th>سعر الخدمة</th>
                                                <th>قيمة الخصم</th>
                                                <th>نسبة الضريبة</th>
                                                <th>قيمة الضريبة</th>
                                                <th>الاجمالي مع الضريبة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <select wire:model.live="Group_id" class="form-control"
                                                        wire:change="get_price" id="exampleFormControlSelect1"
                                                        style="width: fit-content;">
                                                        <option value="">-- اختار الخدمة --</option>
                                                        @foreach ($Groups as $Group)
                                                            <option value="{{ $Group->id }}">{{ $Group->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input wire:model.live="price" type="number" min="0"
                                                        class="form-control" readonly></td>
                                                <td><input wire:model.live="discount_value" type="number"
                                                        min="0" class="form-control" style="width: 100px"></td>
                                                <th><input style="width: fit-content;" wire:model.live="tax_rate"
                                                        type="number" class="form-control" min="0"
                                                        max="100" style="width: 60px">
                                                </th>
                                                <td><input type="number" class="form-control"
                                                        wire:model.live="tax_value" readonly></td>

                                                <td><input type="text" class="form-control" readonly
                                                        wire:model.live='subtotal'></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!-- bd -->
                            </div><!-- bd -->
                        </div><!-- bd -->
                    </div>
                </div>

                <input class="btn btn-outline-success" type="submit" value="تاكيد البيانات">
            </form>

        </div>
    </div>
</div>
