@extends('Dashboard.layouts.master')
@section('css')
@endsection
@section('title')
   تعديل بيانات مريض
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المرضي</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  تعديل بيانات مريض</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
<!-- row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                    <form action="{{route('Patients.update',$Patient->id)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                    <div class="row">
                        <div class="col-3">
                            <label>اسم المريض</label>
                            <input type="text" name="name"  value="{{$Patient->name}}" class="form-control @error('name') is-invalid @enderror " >
                            <input type="hidden" name="id" value="{{$Patient->id}}">
                        </div>

                        <div class="col">
                            <label>البريد الالكتروني</label>
                            <input type="email" name="email"  value="{{$Patient->email}}" class="form-control @error('email') is-invalid @enderror" >
                        </div>


                        <div class="col">
                            <label>تاريخ الميلاد</label>
                            <input class="form-control fc-datepicker" value="{{$Patient->Date_Birth}}" name="Date_Birth" type="text" >
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-3">
                            <label>رقم الهاتف</label>
                            <input type="number" name="Phone"  value="{{$Patient->Phone}}" class="form-control @error('Phone') is-invalid @enderror" >
                        </div>

                        <div class="col">
                            <label>الجنس</label>
                            <select class="form-control" name="gender_id" >
                                @foreach ($genders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label>فصلية الدم</label>
                            <select class="form-control" name="Blood_Group" >
                                <option value="O-"{{$Patient->Blood_Group == "O-" ? 'selected':''}} >O-</option>
                                <option value="O+" {{$Patient->Blood_Group == "O+" ? 'selected':''}}>O+</option>
                                <option value="A+" {{$Patient->Blood_Group == "A+" ? 'selected':''}}>A+</option>
                                <option value="A-" {{$Patient->Blood_Group == "A-" ? 'selected':''}}>A-</option>
                                <option value="B+" {{$Patient->Blood_Group == "B+" ? 'selected':''}}>B+</option>
                                <option value="B-" {{$Patient->Blood_Group == "B-" ? 'selected':''}}>B-</option>
                                <option value="AB+"{{$Patient->Blood_Group == "AB+" ? 'selected':''}}>AB+</option>
                                <option value="AB-"{{$Patient->Blood_Group == "AB-" ? 'selected':''}}>AB-</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>العنوان</label>
                            <textarea rows="5" cols="10" class="form-control" name="Address">{{$Patient->Address}}</textarea>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success">حفظ البيانات</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@endsection
