@extends('backend.layouts.app')
@section('content')

<!--begin::Toolbar-->
<div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <h4 class="text-white fw-bolder fs-2qx me-5">Create Vehicle</h4>
    </div>       
            {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
        <a href="{{ route('admin.vehicle') }}" class="btn btn-secondary my-2"><i class="bx bx-plus"></i>Back</a>
        </div>
  </div>
  <!--end::Toolbar-->

  
    <form action="{{ route('admin.testsubmit') }}" method="POST">
        @csrf

        <select name="product">
            <option>thunder2</option>
            <option value="3">thunder cool</option>
            <option selected>hello</option>
            <option>thunder3</option>
        </select>
        <input type="text" name="username">

        <button type="submit">submit</button>
    </form>
@endsection
