@extends('backend.layouts.app')
@section('title', 'Admin Users')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">Products Details</h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Products Details</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products Details</li>
        </ol>
      </nav>
    </div>

     <section id="basic-datatable">
           <div class="row">
                <div class="col-lg-11 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="text-start">
                      <h4 class="card-title">Products Details</h4>
                      </div>
                        {{-- @can('Create Admin Users') --}}
                        <div class="text-end">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
                        <a href="{{ route('admin.products') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                        </div>
                        {{-- @endcan --}}
                        <div class="table-responsive">
                          <table class="table zero-configuration" id="">
                            <thead>
                                 <tr>
                                         <th>#</th>
                                         <th>Product Name</th>
                                         <th>Product Code</th>
                                         <th>Product Rate</th>
                                         <th>Product Stock</th>
                                         <th>Hsn Code</th>
                                         <th>Sac Code</th>
                                         <th>Tax %</th>
                                         <th>Product Unit</th>
                                         <th>Gst %</th>
                                         <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                           @if(isset($products) && count($products)>0)
                                           @php $srno = 1; @endphp
                                           @foreach($products as $product_data)
                                           <tr>
                                             <td>{{ $srno }}</td>
                                             <td>{{ $product_data->product_name }}</td>
                                             <td>{{ $product_data->product_code }}</td>
                                             <td>{{ $product_data->product_rate }}</td>
                                             <td>{{ $product_data->product_stock }}</td>
                                             <td>{{ $product_data->hsn_code }}</td>
                                             <td>{{ $product_data->sac_code }}</td>
                                             <td>{{ $product_data->tax_percent }}</td>
                                             <td>{{ $product_data->product_unit }}</td>
                                             <td>{{ $product_data->gst_percent }}</td>
                                             <td>
                                                             {{-- @can('Update Admin Users') --}}
                                                             <a href="{{ url('admin/products/edit/'.$product_data->product_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i>Edit</a>
                                                             {{-- @endcan --}}
                                                             {!! Form::open([
                                                                   'method'=>'GET',
                                                                   'url' => ['admin/products/delete', $product_data->product_id],
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
