@extends('backend.layouts.app')
@section('title', 'Product Grouping')

@section('content')

<!--begin::Toolbar-->
<div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
    <!--begin::Container-->
    {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
      {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Products Grouping</h4>
        </div>       
                {{-- @can('Create Admin Users') --}}
            <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            {{-- <a href="{{ route('admin.products.create') }}" class="btn btn-success my-2" data-bs-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a> --}}
            </div>
            {{-- </div> --}}
    {{-- </div> --}}
    <!--end::Container-->
  </div>
  <!--end::Toolbar-->

  <section class="db-section admin-form">
      <div class="content">
          <section id="basic-datatable">
              <div class="row">
                  <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              <div class="d-flex align-items-center">
                                  {{-- <h4 class="card-title">Products Details</h4> --}}
  
  
  
                                  {{-- @can('Create Admin Users') --}}
                                  {{-- <div class="text-end" style="position: absolute;
                          right: 50px;">
                                      <a href="{{ route('admin.products.create') }}" class="btn btn-inverse-primary btn-fw"><i
                                              class="bx bx-plus"></i> Add </a>
                                  </div> --}}
                              </div>
                              {{-- @endcan --}}
                              <div class="table-responsive">
  
                                  {{-- {{ Form::open(['url' => 'admin/state/store']) }} --}}
                                  <div class="row align-items-end">
                                    <div class="col-md-6 col-lg-6 col-sm-12">
                                        <div class="form-label-group">
                                            {{ Form::label('group_id', 'Group Name *') }}
                                            {{ Form::select('group_id', $product_name, null, ['class' => 'form-select' , 'id'=> 'group_id','placeholder' => 'Select The Group']) }}
                                        </div>
                                    </div>
    
                                    <div class="col-md-3 " >
                                        {{ Form::submit('Assign', ['class' => 'btn btn-primary mb-1', 'id' => 'Assign']) }}
                                        {{-- </div> --}}
                                        {{-- <div class="col-12 d-flex justify-content-start"> --}}
                                        {{ Form::submit('Unassign', ['class' => 'btn btn-primary mb-1','id' => 'Unassign']) }}
                                    </div>
                                  </div>
                                  
  
                                  {{-- {{ Form::close() }} --}}
  
                                  <table class="table zero-configuration table-responsive" id="tbl-datatable">
                                      <thead>
                                          <tr>
                                              <th>Select</th>
                                              <th>#Srno</th>
                                              <th>Product Name</th>
                                              <th>Group Name</th>
                                              <th>Product Rate</th>
                                          </tr>
                                      </thead>
  
  
                                      <tbody>
                                          @if (isset($products) && count($products) > 0)
                                              @php $srno = 1; @endphp
                                              @foreach ($products as $product_data)
                                                  <tr class='selected_data' id={{ $product_data->product_id }}>
                                                      {{-- <td><input type="checkbox" name="checkbox[]" value=""></td> --}}
                                                      <td></td>
                                                      <td>{{ $srno }}</td>
                                                      <td style="text-align: left ">{{ $product_data->product_name }}</td>
  
                                                      @if (isset($product_data->group->group_name))
                                                          <td style="text-align: left ">
                                                              {{ $product_data->group->group_name }}
                                                          </td>
                                                      @else
                                                          <td>{{ '-' }}</td>
                                                      @endif
  
  
                                                      <td>{{ $product_data->product_rate }}</td>
  
  
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

    {{-- @section('scripts') --}}
    {{-- <script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {




            $('#tbl-datatable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#tbl-datatable thead');

            var table = $('#tbl-datatable').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();

                            $(cell).html(
                                '<input type="text" style="width:150px;" placeholder="' +
                                title + '" />');

                            $(
                                    'input', $('.filters th').eq($(api.column(colIdx).header())
                                        .index())
                                )
                                .off('keyup change')
                                .on('change', function(e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();
                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '', this.value != '', this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function(e) {
                                    e.stopPropagation();
                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }],
                select: {
                    style: 'multi',
                    selector: 'td:first-child'
                },
                order: [
                    [1, 'asc']
                ]
            });

            table.draw();





            //cheakbox code

            $('#Assign').click(function() {
                let selected_data = [];
                // console.log('clok');
                $(".selected").each(function() {
                    let sel_id = $(this).attr('id');
                    // console.log(sel_id);
                    selected_data.push(sel_id);
                });
                if (selected_data.length > 0) {
                    //ok
                    let con = confirm('Are you sure, you want to Assign the group');

                    var group_id = $('#group_id').val();
                    if (con) {
                        let token = "{{ csrf_token() }}";
                        let send_data = {
                            '_token': token,
                            'vals': selected_data,
                            'group_id': group_id
                        };

                        //ajax call
                        $.ajax({
                            url: "{{ url('/') }}/admin/grouping/selected/product",
                            type: 'POST',
                            data: send_data,
                            success: function(resp) {
                               console.log(resp);
                               location.reload(); 
                            }

                        });

                    }
                } else {
                    //select element first
                }


            });


            $('#Unassign').click(function() {
                let selected_data = [];
                // console.log('clok');
                $(".selected").each(function() {
                    let sel_id = $(this).attr('id');
                    // console.log(sel_id);
                    selected_data.push(sel_id);
                });
                if (selected_data.length > 0) {
                    //ok
                    let con = confirm('Are you sure, you want to Assign the group');

                    var group_id = $('#group_id').val();
                    if (con) {
                        let token = "{{ csrf_token() }}";
                        let send_data = {
                            '_token': token,
                            'vals': selected_data,
                            'group_id': group_id
                        };

                        //ajax call
                        $.ajax({
                            url: "{{ url('/') }}/admin/grouping/selected/product/unassign",
                            type: 'POST',
                            data: send_data,
                            success: function(resp) {
                               console.log(resp);
                               location.reload(); 
                            }

                        });

                    }
                } else {
                    //select element first
                }


            });
        });
    </script>
@endsection
