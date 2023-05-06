@extends('backend.layouts.app')
@section('title', 'Admin Users')

@section('content')

    <div class="content">


        <section id="basic-datatable">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-start">
                                <h4 class="card-title">Vehicle Details</h4>
                            </div>
                            {{-- @can('Create Admin Users') --}}
                            <div class="text-end">
                                <a href="{{ url('admin/vehicle/addvehicle/' . $customer_id) }}"
                                    class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
                            </div>
                            {{-- @endcan --}}
                            <div class="table-responsive">
                                <table class="table zero-configuration" id="tbl-datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Vehicle Make</th>
                                            <th>Vehicle Model</th>
                                            <th>Vehicle No</th>
                                            <th>Chssis No</th>
                                            <th>Serial No</th>
                                            {{-- <th>Cab No</th>
                                      <th>Loco No</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($vehicle) && count($vehicle) > 0)
                                            @php $srno = 1; @endphp
                                            @foreach ($vehicle as $vehicle_details)
                                                <tr>
                                                    <td>{{ $srno }}</td>
                                                    <td>{{ $vehicle_details->make->vehicle_make_name }}</td>
                                                    <td>{{ $vehicle_details->model->vehicle_model_name }}</td>
                                                    <td>{{ $vehicle_details->vehicle_no }}</td>
                                                    <td>{{ $vehicle_details->chassis_no }}</td>
                                                    <td>{{ $vehicle_details->serial_no }}</td>
                                                    {{-- <td>{{ $vehicle_details->cab_no }}</td>
                                      <td>{{ $vehicle_details->loco_no }}</td> --}}

                                                    <td>
                                                        {{-- @can('Update Admin Users') --}}
                                                        <a href="{{ url('admin/vehicle/edit/' . $vehicle_details->vehicle_id) }}"
                                                            class="btn btn-primary"><i class="bx bx-pencil"></i>Edit</a>
                                                        {{-- @endcan --}}
                                                        {!! Form::open([
                                                            'method' => 'GET',
                                                            'url' => ['admin/vehicle/delete', $vehicle_details->vehicle_id],
                                                            'style' => 'display:inline',
                                                        ]) !!}
                                                        {{-- @can('Delete Admin Users') --}}
                                                        {!! Form::button('Delete', [
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-danger',
                                                            'onclick' => "return confirm('Are you sure you want to Delete this Entry ?')",
                                                        ]) !!}
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
