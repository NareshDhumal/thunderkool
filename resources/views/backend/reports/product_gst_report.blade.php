@extends('backend.layouts.app')
@section('title', 'Product Gst Report')

@section('content')


<!--begin::Toolbar-->
<div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
    <!--begin::Container-->
    {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
      {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Products Gst Report</h4>
        </div>       
                {{-- @can('Create Admin Users') --}}
                <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
                {{-- <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary my-2 me-4" id="export_excel" data-bs-toggle="tooltip" title="Back"><i class="fa fa-arrow-left"></i></a> --}}
                {{-- <a href="" class="btn btn-success my-2" id="export_excel"><i class="bx bx-plus"></i>Export To Excel</a> --}}
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
                              {{-- <div class="d-flex align-items-center">
                                  <h4 class="card-title">Products Details</h4> --}}
  
                                  {{-- @can('Create Admin Users') --}}
                                  {{-- <div class="text-end" style="position: absolute;
                                  right: 50px;">
                                  <a href="{{ route('admin.dashboard') }}" class="btn btn-inverse-primary float-right">
                                      <span class="align-middle ml-25">Back</span></a>
  
                              </div> --}}
                              {{-- </div> --}}
                              {{-- @endcan --}}
                              <div class="table-responsive">
                                  <table class="table zero-configuration table-responsive" id="tbl-datatable">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th class="text-center">Product Name</th>
                                              <th>Hsn Code</th>
                                              <th>Product Stock</th>
                                              <th>Product Rate</th>
                                              {{-- <th>Igst</th>
                                              <th>Sgst</th>
                                              <th>Cgst</th> --}}
                                              {{-- <th>Total Amt</th> --}}
  
  
                                          </tr>
                                      </thead>
  
                                      <tbody>
                                          @if (isset($gst_reports) && count($gst_reports) > 0)
                                              @php $srno = 1; @endphp
                                              @foreach ($gst_reports as $product_data)
                                                  {{-- @foreach ($product_data->purchasebill as $purchase_data) --}}
                                                      <tr>
                                                          <td>{{ $srno }}</td>
                                                          <td>{{ $product_data->product_name }}</td>
                                                          <td>{{ $product_data->hsn_code }}</td>
                                                          <td>{{ $product_data->product_stock }}</td>
                                                          <td>{{ $product_data->product_rate }}</td>
  
  
                                                          {{-- @if ($purchase_data->igst)
                                                              <td>{{ $purchase_data->igst }}</td>
                                                       
                                                          @endif
                                                          @if ($purchase_data->sgst)
                                                              <td>{{ $purchase_data->sgst }}</td>
                                                         
                                                          @endif
                                                          @if ($purchase_data->cgst)
                                                              <td>{{ $purchase_data->cgst }}</td>
                                                      
                                                          @endif --}}
  
  
                                                          {{-- <td>{{ $purchase_data->igst + $purchase_data->sgst + $purchase_data->cgst }}
                                                          </td> --}}
  
                                                      </tr>
                                                      @php $srno++; @endphp
                                                  {{-- @endforeach --}}
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


            // Setup - add a text input to each footer cell
            // $('#tbl-datatable tfoot th').each(function() {
            //     var title = $('#tbl-datatable tfoot th').eq($(this).index()).text();
            //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            // });

            // // DataTable
            // var table = $('#tbl-datatable').DataTable();

            // // Apply the search
            // table.columns().every(function() {
            //     var that = this;

            //     $('input', this.footer()).on('keyup change', function() {
            //         that
            //             .search(this.value)
            //             .draw();
            //     });
            // });

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
            });

            table.draw();
        });
    </script>
@endsection
