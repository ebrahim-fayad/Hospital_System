@extends('Dashboard.layouts.master')
@section('css')
@endsection

@section('title')
    تعديل سند صرف
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الحسابات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                    سند صرف </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @include('Dashboard.messages_alert')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Payment.update',$Payment->id) }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>اسم المريض</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="patient_id" class="form-control select2" required>
                                        @foreach ($Patients as $Patient)
                                            <option value=""></option>
                                            <option value="{{ $Patient->id }}" {{ $Payment->patient_id == $Patient->id ? 'selected':'' }}>
                                                <p> {{ $Patient->name }}</p>
                                               <div class="text-denger">الاجمالي : {{ $Patient->PatientAccounts->sum('Debit') -  $Patient->PatientAccounts->sum('credit') }}</div>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>المبلغ</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="Debit" value="{{ $Payment->amount }}" type="number">
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>البيان</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <textarea class="form-control" name="description"  rows="3">{{ $Payment->description }}</textarea>
                                </div>
                            </div>

                            <button type="submit"
                                class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ trans('Doctors.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
