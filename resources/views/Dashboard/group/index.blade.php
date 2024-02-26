@extends('Dashboard.layouts.master')
@section('css')
@endsection
@section('title')
    {{ trans('Groups.services_groups') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Groups.groups') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/{{ trans('Groups.services_groups') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    @livewire('Dashboard.group.create-group')
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('morph.updated', ({
                el,
                component
            }) => {



                const myAlert = document.getElementById('ServiceSaved')

                if (myAlert) {
                    setTimeout(() => {
                        myAlert.style.display = 'none'
                    }, 1000)
                }
            })
        });
    </script>
@section('js')
@endsection
@endsection
