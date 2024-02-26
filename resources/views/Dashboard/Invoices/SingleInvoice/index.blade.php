@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('main-sidebar_trans.invoices') }}
@stop
@section('css')

@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.invoices') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                   {{ trans('Single_Invoice.add_service') }}</span>
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
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="card-header pb-0">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#create"> {{ trans('Single_Invoice.add_service') }}</button>


                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        @livewire('Dashboard.Invoices.SingleInvoice.single-invoice-data')
                        <!--/div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    @livewire('Dashboard.Invoices.SingleInvoice.single-invoice-create')
    @livewire('Dashboard.Invoices.SingleInvoice.single-invoice-update')
    @livewire('Dashboard.Invoices.SingleInvoice.single-invoice-delete')
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    <script>
        window.addEventListener('create', event => {
            $('#create').modal('toggle');
        })
        window.addEventListener('updateModal', event => {
            $('#updateModal').modal('toggle');
        })
        window.addEventListener('deleteModal', event => {
            $('#deleteModal').modal('toggle');
        })
    </script>
@endsection
@section('js')
@endsection
