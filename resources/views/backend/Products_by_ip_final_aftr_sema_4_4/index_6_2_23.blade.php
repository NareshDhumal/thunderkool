@extends('backend.layouts.app')
@section('title', 'Admin Users')

@section('content')

    <div class="content">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Products Details</h4>

                                {{-- @can('Create Admin Users') --}}
                                <div class="text-end" style="position: absolute;
                        right: 50px;">
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-inverse-primary btn-fw"><i
                                            class="bx bx-plus"></i> Add </a>
                                </div>
                            </div>
                            {{-- @endcan --}}
                            <div class="table-responsive">
                                <table class="table zero-configuration table-responsive" id="tbl-datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            {{-- <th>Product Code</th> --}}
                                            <th>Product Rate</th>
                                            <th>Product Stock</th>
                                            <th>Hsn Code</th>
                                            {{-- <th>Sac Code</th> --}}
                                            {{-- <th>Tax %</th> --}}
                                            <th>Product Unit</th>
                                            <th>Gst %</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($products) && count($products) > 0)
                                            @php $srno = 1; @endphp
                                            @foreach ($products as $product_data)
                                                <tr>
                                                    <td>{{ $srno }}</td>
                                                    <td>{{ $product_data->product_name }}</td>
                                                    {{-- <td>{{ $product_data->product_code }}</td> --}}
                                                    <td>{{ $product_data->product_rate }}</td>
                                                    <td>{{ $product_data->product_stock }}</td>
                                                    <td>{{ $product_data->hsn_code }}</td>
                                                    {{-- <td>{{ $product_data->sac_code }}</td> --}}
                                                    {{-- <td>{{ $product_data->tax_percent }}</td> --}}
                                                    <td>{{ $product_data->product_unit }}</td>
                                                    <td>{{ $product_data->gst_percent }}</td>
                                                    <td style="display: flex;gap:10px">
                                                        {{-- @can('Update Admin Users') --}}
                                                        <a href="{{ url('admin/products/edit/' . $product_data->product_id) }}"
                                                            class="btn btn-primary"><i class="bx bx-pencil"></i>Edit</a>
                                                        {{-- @endcan --}}
                                                        {!! Form::open([
                                                            'method' => 'GET',
                                                            'url' => ['admin/products/delete', $product_data->product_id],
                                                            'style' => 'display:inline',
                                                        ]) !!}
                                                        {{-- @can('Delete Admin Users') --}}
                                                        {!! Form::button('<i class="bx bx-trash">Delete</i>', [
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

    {{-- @section('scripts') --}}
    {{-- <script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            $('#tbl-datatable').DataTable();
        });
    </script>
@endsection
