@extends('backend.layouts.app')
@section('title', 'Roles')

@section('content')

  <div class="content">
   
<section id="basic-datatable">
    <div class="row">
                      <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex w-100 align-items-center">
                            <h4 class="card-title page-title">Roles</h4>
                            
                              {{-- @can('Create Admin Users') --}}
                              <div class="text-end" style="position: absolute; right:60px">
                              <a href="{{ route('admin.roles.create') }}" class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
                              <a href="{{ route('admin.roles') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                            </div></div>
                              {{-- @endcan --}}
                        <div class="table-responsive table-full-width">
                            <table class="table zero-configuration " id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Name</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($roles) && count($roles)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($roles as $role)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $role->name }}</td>
                                      <td>
                                        <!-- @can('Update') -->
                                        <!-- @endcan -->
                                        <a href="{{ url('admin/roles/edit/'.$role->id) }}" class="btn btn-primary"><i class="bx bx-pencil">Edit</i></a>
                                        <!-- @can('Delete') -->
                                        <!-- @endcan -->
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/roles/delete', $role->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="bx bx-trash">Delete</i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
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
</section>
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
