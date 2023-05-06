@extends('backend.layouts.app')
@section('title', 'Admin Users')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <!--begin::Container-->
        {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
        {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Admin Users</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class="col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.adminusers.create') }}" class="btn btn-success my-2" data-bs-toggle="tooltip"
                title="Add"><i class="fa fa-plus"></i></a>
        </div>
        {{-- </div> --}}
        {{-- </div> --}}
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->


    <section class="admin-table db-section">
        <div class="content">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                {{-- <div class="d-flex align-items-center w-100"> --}}
                                {{-- <h4 class="card-title">Admin Users</h4> --}}

                                {{-- @can('Create Admin Users') --}}
                                {{-- <div class="text-end" style="position: absolute;
                     right: 50px;">
                     <a href="{{ route('admin.adminusers.create') }}" class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
                     </div>
                    </div> --}}
                                {{-- @endcan --}}
                                <div class="table-responsive">
                                    <table class="table zero-configuration table-bordered" id="tbl-datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($adminusers) && count($adminusers) > 0)
                                                @php $srno = 1; @endphp
                                                @foreach ($adminusers as $user)
                                                    <tr>
                                                        <td>{{ $srno }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->lastname }}</td>
                                                        <td>{{ $user->email }}</td>

                                                        <td>{{ isset($user->userrole->name) ? $user->userrole->name : '' }}</td>
                                                        <td
                                                            style="{{ $user->account_status == 1 ? 'color: Green;' : 'color: red;' }}">{{ $user->account_status == 1 ? 'Active' : 'Inactive' }}</td>

                                                        <td>
                                                            {{-- @can('Update Admin Users') --}}
                                                            <a href="{{ url('admin/adminusers/edit/' . $user->id) }}"
                                                                class="btn btn-sm btn-primary" title="Edit"
                                                                data-bs-toggle="tooltip"><i class="fa fa-pen"></i></a>
                                                            {{-- @endcan --}}
                                                            {!! Form::open([
                                                                'method' => 'GET',
                                                                'url' => ['admin/adminusers/delete', $user->id],
                                                                'style' => 'display:inline',
                                                            ]) !!}
                                                            {{-- @can('Delete Admin Users') --}}
                                                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-sm btn-danger',
                                                                'data-bs-toggle' => 'tooltip',
                                                                'title' => 'Delete',
                                                                'onclick' => "return confirm('Are you sure you want to Delete this Entry ?')",
                                                            ]) !!} {{-- @endcan --}}
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
