@extends('Dashboard.layouts.master')
@section('title')
  الاشعة-- قائمة الموظفين
@stop
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاشعة</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الموظفين</span>
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
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                           اضافة موظف جديد
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table style="text-align: center" class="table text-md-nowrap" id="example1">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                 <th>{{ trans('doctors.img') }}</th>
                                                <th>الاسم</th>
                                                <th >البريد الالكتروني</th>
                                                <th>تاريخ الاضافة</th>
                                                <th >العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                           @foreach($ray_employees as $ray_employee)
                                               <tr>
                                                   <td>{{$loop->iteration}}</td>
                                                   <td>
                                            @if ($ray_employee->image)
                                                <img src="{{ asset('Dashboard/img/' . $ray_employee->image->fileName) }}"
                                                    height="50px" width="50px" alt="">
                                            @else
                                                <img src="{{ asset('Dashboard/img/ray_employee.jpg') }}" height="50px"
                                                    width="50px" alt="">
                                            @endif
                                        </td>
                                                   <td>{{$ray_employee->name}}</td>
                                                   <td>{{ $ray_employee->email }}</td>
                                                   <td>{{ $ray_employee->created_at->diffForHumans() }}</td>
                                                   <td>
                                                       <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$ray_employee->id}}"><i class="las la-pen"></i></a>
                                                       <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$ray_employee->id}}"><i class="las la-trash"></i></a>
                                                   </td>
                                               </tr>

                                               @include('Dashboard.RayEmployees.edit')
                                               @include('Dashboard.RayEmployees.delete')

                                           @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- bd -->
                            </div><!-- bd -->
                        </div>
                        <!--/div-->

                    @include('Dashboard.RayEmployees.add')
                    <!-- /row -->

				</div>
				<!-- row closed -->

			<!-- Container closed -->

		<!-- main-content closed -->
@endsection
@section('js')
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
<script>
    var loadFiled = function(event) {
        var outputed = document.getElementById('outputed');
        outputed.src = URL.createObjectURL(event.target.files[0]);
        outputed.onload = function() {
            URL.revokeObjectURL(outputed.src) // free memory
        }
    };
</script>
@endsection
