@extends('backend.layouts.app')
@section('title', 'Admin Users')

@section('content')

<!--begin::Toolbar-->
<div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
  <div class="col-lg-6 col-md-6 col-sm-12">
      <h4 class="text-white fw-bolder fs-2qx me-5">Vichcle Make Details</h4>
  </div>       
          {{-- @can('Create Admin Users') --}}
      <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
      <a href="{{ route('admin.vehiclemake.create') }}" class="btn btn-success my-2"><i class="bx bx-plus"></i>Add</a>
      </div>
</div>
<!--end::Toolbar-->

<section class="db-section">
  <div class="content">
     <section id="basic-datatable">
           <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      {{-- <div class="text-start">
                      <h4 class="card-title">Vichcle Make Details</h4>
                      </div> --}}
                        {{-- @can('Create Admin Users') --}}
                        {{-- <div class="text-end">
                        <a href="{{ route('admin.vehiclemake.create') }}" class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
                        </div> --}}
                        {{-- @endcan --}}
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Vichcle Make</th>
                                      <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($vehicle_make) && count($vehicle_make)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($vehicle_make as $vehicle_make_details)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $vehicle_make_details->vehicle_make_name }}</td>
                                      <td>
                                        {{-- @can('Update Admin Users') --}}
                                        <a href="{{ url('admin/vehiclemake/edit/'.$vehicle_make_details->vehicle_make_id  ) }}" class="btn btn-primary"><i class="bx bx-pencil"></i>Edit</a>
                                        {{-- @endcan --}}
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/vehiclemake/delete', $vehicle_make_details->vehicle_make_id  ],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {{-- @can('Delete Admin Users') --}}
                                            {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
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
</section>


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
