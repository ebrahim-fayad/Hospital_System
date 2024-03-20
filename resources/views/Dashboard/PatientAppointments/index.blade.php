@extends('Dashboard.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المواعيد</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المواعيد</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المريض</th>
                                <th>البريد الالكتروني</th>
                                <th>القسم</th>
                                <th>الدكتور</th>
                                <th>الهاتف</th>
                                <th>ملاحظات</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$appointment->name}}</a></td>
                                    <td>{{$appointment->email}}</td>
                                    <td>{{$appointment->section->name}}</td>
                                    <td>{{$appointment->doctor->name}}</td>
                                    <td>{{$appointment->phone}}</td>
                                    <td>{{$appointment->notes}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                data-target="#approval{{$appointment->id}}"><i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#Refusal{{$appointment->id}}"><i class="fas fa-remove-format"></i>
                                        </button>
                                    </td>
                                </tr>
                                 @include('Dashboard.PatientAppointments.approval')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

@endsection
