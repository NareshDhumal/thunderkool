@extends('backend.layouts.app')
@section('title', 'Roles')

@section('content')

<!--begin::Toolbar-->
<div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
    <!--begin::Container-->
    {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
      {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Roles</h4>
        </div>       
                {{-- @can('Create Admin Users') --}}
            <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-success my-2"><i class="fa fa-plus"></i></a>
            </div>
            {{-- </div> --}}
    {{-- </div> --}}
    <!--end::Container-->
  </div>
  <!--end::Toolbar-->

  <section class="db-section admin-form">

      <div class="content">
  
          <section id="basic-datatable">
              <div class="row">
                  <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              {{-- <div class="text-start">
                                  <h4 class="card-title">Roles</h4>
                              </div> --}}
                              {{-- @can('Create Admin Users') --}}
                              {{-- <div class="text-end">
                                  <a href="{{ route('admin.roles.create') }}" class="btn btn-inverse-primary btn-fw"><i
                                          class="bx bx-plus"></i> Add </a>
                                 
                              </div> --}}
                              {{-- @endcan --}}
                              <div class="table-responsive">
                                  <table class="table zero-configuration" id="tbl-datatable">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Name</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @if (isset($roles) && count($roles) > 0)
                                              @php $srno = 1; @endphp
                                              @foreach ($roles as $role)
                                                  <tr>
                                                      <td>{{ $srno }}</td>
                                                      <td>{{ $role->name }}</td>
                                                      <td>
                                                          <!-- @can('Update')
          -->
                                                              <!--
      @endcan -->
                                                          <a href="{{ url('admin/roles/edit/' . $role->id) }}"
                                                              class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                                          <!-- @can('Delete')
          -->
                                                              <!--
      @endcan -->
                                                          {!! Form::open([
                                                              'method' => 'GET',
                                                              'url' => ['admin/roles/delete', $role->id],
                                                              'style' => 'display:inline',
                                                          ]) !!}
                                                          {!! Form::button('<i class="fa fa-trash"></i>', [
                                                              'type' => 'submit',
                                                              'class' => 'btn btn-danger',
                                                              'onclick' => "return confirm('Are you sure you want to Delete this Entry ?')",
                                                          ]) !!}
                                                          {!! Form::close() !!}
                                                      </td>
                                                  </tr>
                                                  @php $srno++; @endphp
                                              @endforeach
                                          @endif
                                      </tbody>
  
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
  
          </section>
   </div>
  </section>

@endsection
@section('scripts')
    <script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>

    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
