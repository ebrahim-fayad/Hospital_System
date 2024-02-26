@extends('Dashboard.layouts.master')
@section('title')
    سندات الصرف
@stop
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الحسابات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ سندات
                    الصرف</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('Payment.create') }}" class="btn btn-primary" role="button"
                            aria-pressed="true">اضافة سند جديد</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المريض</th>
                                    <th>المبلغ</th>
                                    <th>البيان</th>
                                    <th>تاريخ الاضافة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->patients->name }}</td>
                                        <td>{{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ \Str::limit($payment->description, 50) }}</td>
                                        <td>{{ $payment->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('Payment.edit', $payment->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $payment->id }}"><i
                                                    class="las la-trash"></i></a>
                                            <a href="{{ route('Payment.show', $payment->id) }}"
                                                class="btn btn-primary btn-sm" target="_blank" title="طباعه سند صرف"><i
                                                    class="fas fa-print"></i></a>
                                        </td>

                                    </tr>
                                    @include('Dashboard.Payments.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!-- /row -->

    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')
@endsection
