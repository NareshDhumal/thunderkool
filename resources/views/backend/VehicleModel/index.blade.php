@extends('backend.layouts.app')
@section('title', 'Vehicle Models')

@section('content')

   <!--begin::Toolbar-->
   <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
    <!--begin::Container-->
    {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
    {{-- <div class=""> --}}
    <div class="col-lg-6 col-md-6 col-sm-12">
        <h4 class="text-white fw-bolder fs-2qx me-5">Vehicle Model</h4>
    </div>
    {{-- @can('Create Admin Users') --}}
    <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
    <a href="{{ route('admin.vehiclemodel.addmodel',$make_id) }}" class="btn btn-success my-2" data-bs-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
        </div>
>
    {{-- </div> --}}
    {{-- </div> --}}
    <!--end::Container-->
</div>
<!--end::Toolbar-->

  <div class="content">
     <section id="basic-datatable">
           <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="text-start">
                      {{-- <h4 class="card-title">Vehicle Model</h4> --}}
                      </div>
                        {{-- @can('Create Admin Users') --}}
                        {{-- <div class="text-end">
                        <a href="{{ route('admin.vehiclemodel.addmodel',$make_id) }}" class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
                        </div> --}}
                        {{-- @endcan --}}
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Vehicle Model</th>
                                      <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($Vehicle_model) && count($Vehicle_model)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($Vehicle_model as $Vehicle_model_details)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $Vehicle_model_details->vehicle_model_name }}</td>
                               
                                      <td>
                                        {{-- @can('Update Admin Users') --}}
                                        <a href="{{ url('admin/vehiclemodel/edit/'.$Vehicle_model_details->vehicle_model_id  ) }}" class="btn btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-pen"></i></a>
                                        {{-- @endcan --}}
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/vehiclemodel/delete', $Vehicle_model_details->vehicle_model_id  ],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {{-- @can('Delete Admin Users') --}}
                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','data-bs-toggle'=>'tooltip','title'=> 'Delete','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                        {{-- @endcan --}}
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


{{-- @endsection
@section('scripts')
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script> --}}

<script>
  $(document).ready(function() {
      $('#tbl-datatable').DataTable();
  });
</script>
@endsection
