@extends('backend.layouts.app')
@section('title', 'Admin Users')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">Customers Details</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Customers Details</a></li>
          <li class="breadcrumb-item active" aria-current="page">Customers Details</li>
        </ol>
      </nav>
    </div>

     <section id="basic-datatable">
           <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="text-start">
                      <h4 class="card-title">Customers Details</h4>
                      </div>
                        {{-- @can('Create Admin Users') --}}
                        <div class="text-end">
                        <a href="{{ route('admin.Customers.create') }}" class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
                        <a href="{{ route('admin.customers') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                        </div>
                        {{-- @endcan --}}
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Customers Name</th>
                                      <th>Address</th>
                                      <th>Mobile Number</th>
                                      <th>Email</th>
                                      <th>Pin Code</th>
                                      <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($Customers) && count($Customers)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($Customers as $Customers_details)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $Customers_details->customer_name }}</td>
                                      <td>{{ $Customers_details->address }}</td>
                                      <td>{{ $Customers_details->mobile_no }}</td>
                                      <td>{{ $Customers_details->email }}</td>
                                      <td>{{ $Customers_details->pin_code }}</td>

                                      <td>
                                        {{-- @can('Update Admin Users') --}}
                                        <a href="{{ url('admin/customer/edit/'.$Customers_details->customer_id  ) }}" class="btn btn-primary"><i class="bx bx-pencil"></i>Edit</a>
                                        {{-- @endcan --}}
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/customer/delete', $Customers_details->customer_id  ],
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
</section>
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
