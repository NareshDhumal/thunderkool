@extends('backend.layouts.app')
@section('title', 'Vehicle Make Details')


@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Vehicle Make Details</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.vehiclemake.create') }}" class="btn btn-success my-2" title="Add" data-bs-toggle="tooltip"><i class="fa fa-plus"></i></a>
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
                                                <th>Vehicle Make</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($vehicle_make) && count($vehicle_make) > 0)
                                                @php $srno = 1; @endphp
                                                @foreach ($vehicle_make as $vehicle_make_details)
                                                    <tr>
                                                        <td>{{ $srno }}</td>
                                                        <td>{{ $vehicle_make_details->vehicle_make_name }}</td>
                                                        <td class="d-flex gap-2">
                                                            {{-- @can('Update Admin Users') --}}
                                                            <a href="{{ url('admin/vehiclemake/edit/' . $vehicle_make_details->vehicle_make_id) }}"
                                                                class="btn btn-sm btn-primary" title="Edit" data-bs-toggle="tooltip"><i class="fa fa-pen"></i></a>
                                                            {{-- @endcan --}}
                                                            {!! Form::open([
                                                                'method' => 'GET',
                                                                'url' => ['admin/vehiclemake/delete', $vehicle_make_details->vehicle_make_id],
                                                                'style' => 'display:inline',
                                                            ]) !!}
                                                            {{-- @can('Delete Admin Users') --}}
                                                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-sm btn-danger','data-bs-toggle'=>'tooltip','title'=> 'Delete',
                                                                'onclick' => "return confirm('Are you sure you want to Delete this Entry ?')",
                                                            ]) !!}
                                                            {{-- @endcan --}}
                                                            {!! Form::close() !!}

                                                            <a href="{{ url('admin/vehiclemodel/' . $vehicle_make_details->vehicle_make_id) }}"
                                                                class="btn btn-sm btn-secondary px-2" title="Add Model" data-bs-toggle="tooltip">Add
                                                                Model</a>
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
