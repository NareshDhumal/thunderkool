@extends('backend.layouts.app')
@section('title', 'Admin Users')

@section('content')


    <div class="main-panel">
        <div class="content-wrapper">

            <section id="basic-datatable">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-start">
                                    <h4 class="card-title">Customer Details</h4>
                                </div>
                                {{-- @can('Create Admin Users') --}}
                                <div class="text-end">
                                    <a href="{{ route('admin.Customers.create') }}"
                                        class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
                                </div>
                                {{-- @endcan --}}
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="tbl-datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customers Name</th>
                                                <th style="max-width:250px;">Address</th>
                                                <th>Mobile Number</th>
                                                <th>Email</th>
                                                <th>Pin Code</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($Customers) && count($Customers) > 0)
                                                @php $srno = 1; @endphp
                                                @foreach ($Customers as $Customers_details)
                                                    <tr>
                                                        <td>{{ $srno }}</td>
                                                        <td>{{ $Customers_details->customer_name }}</td>
                                                        <td style="max-width:250px;">{{ $Customers_details->address }}</td>
                                                        <td>{{ $Customers_details->mobile_no }}</td>
                                                        <td>{{ $Customers_details->email }}</td>
                                                        <td>{{ $Customers_details->pin_code }}</td>

                                                        <td>
                                                            <a href="{{ url('admin/customer/edit/' . $Customers_details->customer_id) }}"
                                                                class="btn btn-primary"><i class="bx bx-pencil"></i>Edit</a>


                                                            <a href="{{ url('admin/customer/delete/' . $Customers_details->customer_id) }}"
                                                                class="btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to Delete this Entry ?')"><i
                                                                    class="bx bx-trash"></i>Delete</a>

                                                            <a href="{{ url('admin/vehicle/' . $Customers_details->customer_id) }}"
                                                                class="btn btn-secondary"><i class="bx bx-trash"></i>Add
                                                                Vehicle</a>

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
