@extends('backend.layouts.app')
@section('title', 'Admin Users')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
          <h4 class="card-title page-title">Admin Users</h4>
          
            {{-- @can('Create Admin Users') --}}
            <div class="text-end" style="position: absolute;right:50px;">
            <a href="{{ route('admin.adminusers.create') }}" class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
              </div></div>
            {{-- @endcan --}}
            <div class="table-responsive">
                <table class="table zero-configuration" id="tbl-datatable">
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
                      @if(isset($adminusers) && count($adminusers)>0)
                        @php $srno = 1; @endphp
                        @foreach($adminusers as $user)
                        <tr>
                          <td>{{ $srno }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->lastname }}</td>
                          <td>{{ $user->email }}</td>

                          <td>{{ isset($user->userrole->name)?$user->userrole->name:'' }}</td>
                          <td>{{($user->account_status==1)?'Active':'Inactive' }}</td>  

                          <td>
                            {{-- @can('Update Admin Users') --}}
                            <a href="{{ url('admin/adminusers/edit/'.$user->id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i>Edit</a>
                            {{-- @endcan --}}
                            {!! Form::open([
                                'method'=>'GET',
                                'url' => ['admin/adminusers/delete', $user->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {{-- @can('Delete Admin Users') --}}
                                {!! Form::button('<i class="bx bx-trash">Delete</i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
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
</div>

@endsection
@section('scripts')
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>

<script>
  $(document).ready(function()
  {

  });
</script>
@endsection
