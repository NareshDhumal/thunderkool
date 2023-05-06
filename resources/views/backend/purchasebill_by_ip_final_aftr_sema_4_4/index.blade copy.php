@extends('backend.layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <style>
        tfoot {
            display: table-header-group;
        }
    </style>
    <div class="content">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-start">
                                <h4 class="card-title page-title">Purchase Bill Reports</h4>
                            </div>

                            <div class="table table-responsive mt-5">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Sr No</th>
                                            <th>Purchase Number</th>
                                            <th>Company Name</th>
                                            <th>Supplier Name</th>
                                            <th>Base Amt</th>
                                            <th>Total</th>

                                        </tr>

                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th style="text-align: center">Sr No</th>
                                            <th>Purchase Number</th>
                                            <th>Company Name</th>
                                            <th>Supplier Name</th>
                                            <th>Base Amt</th>
                                            <th>Total</th>

                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @if (isset($purchase_bill_details) && count($purchase_bill_details) > 0)
                                            @php $srno = 1; @endphp
                                            @foreach ($purchase_bill_details as $purchase_bill)
                                                {{-- @if (isset($purchase_bill->company) && count($purchase_bill->company) > 0)
                                                    @foreach ($purchase_bill->company as $company_details) --}}
                                                    {{ dd($company_details->toArray()) }}
                                                            {{-- @foreach ($purchase_bill->supplier as $suplier_details) --}}
                                                                <tr>
                                                                    <td class='text-center'>{{ $srno }}</td>
                                                                    <td>{{ $purchase_bill->feedback_name }}</td>
                                                                    <td>{{ $company_details->company_name }}</td>
                                                                    <td>
                                                                        {{-- {{ $company_details->supplier->s_name }} --}}
                                                                    </td>
                                                                    <td>{{ $purchase_bill->feedback_meta_value }}</td>
                                                                    <td>{{ $purchase_bill->created_at }}</td>


                                                                </tr>
                                                                @php $srno++; @endphp
                                                            {{-- @endforeach --}}
                                                    {{-- @endforeach
                                                @endif --}}
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


    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        // $(document).ready(function() {

        //     // Setup - add a text input to each footer cell
        //     $('#tbl-datatable thead tr').clone(true).appendTo('#example thead');
        //     $('#tbl-datatable thead tr:eq(1) th').each(function(i) {
        //         var title = $(this).text();
        //         $(this).html('<input type="text" placeholder="Search ' + title + '" />');

        //         $('input', this).on('keyup change', function() {
        //             if (table.column(i).search() !== this.value) {
        //                 table
        //                     .column(i)
        //                     .search(this.value)
        //                     .draw();
        //             }
        //         });
        //     });

        //     var table = $('#tbl-datatable').DataTable({

        //     });


        // });

        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            // DataTable
            var table = $('#example').DataTable({
                initComplete: function() {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },
            });
        });
    </script>
@endsection
