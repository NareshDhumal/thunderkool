@extends('backend.layouts.app')
@section('title', 'Expenses')

@section('content')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.0/js/dataTables.dateTime.min.js">


    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Daily Expenses</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            {{-- <a href="{{ route('admin.productgroupings') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip"
            title="Back"><i class="fa fa-arrow-left"></i></a> --}}
        </div>
    </div>
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            @include('backend.includes.errors')
                            {{ Form::open(['url' => 'admin/dailyexpenses/store', 'class' => 'mb-2']) }}
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Employee Name</label>
                                    <input class="form-control" type="text" name="employee_name"
                                        placeholder="Enter Employee Name">

                                </div>
                                <div class="col-sm-3">
                                    <label>Expense Name</label>
                                    <input class="form-control" type="text" name="expenses_name" id="remark"
                                        placeholder="Enter Expense Name">
                                </div>
                                <div class="col-sm-3">
                                    <label>Date</label>
                                    <input class="form-control" type="date" name="dated" id="dated" value="">
                                </div>
                                <div class="col-sm-3">
                                    <label>Amount Paid</label>
                                    <input class="form-control" type="text" name="amount_paid" id="amount_paid"
                                        placeholder="Enter Amount" onkeypress="return isNumber(event)" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <p class="label_custom">Mode Of Payment</p>
                                            <label class="radio-inline">
                                                <input type="radio" name="payment_mode" id="r1" value="cash"
                                                    required="" style="margin-right:6px;">Cash</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="payment_mode" id="r2" value="cheque"
                                                    style="margin-right:6px;">Cheque</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="payment_mode" id="r3"
                                                    value="electronic Payment" style="margin-right:6px;">Electronic
                                                Payment</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="payment_option">
                                                <!-- <td>Cash</td> -->
                                                <div><span id="pay_cash"></span></div>
                                                <div><input class="form-control" type="text" name="payment_no_or_mode"
                                                        id="payment" style="display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-sm-6 mt-2">
                                    <input class="btn btn-primary edit-pay-submit" type="submit" name="submit"
                                        value="Submit">&nbsp;&nbsp;&nbsp;
                                    <input class="btn btn-primary edit-pay-submit" type="reset" name="reset"
                                        value="Reset">
                                </div>
                            </div>
                            <hr>
                            {{ Form::close() }}



                            {{ Form::open(['url' => 'admin/dailyexpenses', 'method' => 'get']) }}
                            <div class="row align-items-end mb-4">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="Select Start Date">Select Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control"
                                                value="{{ Request::get('start_date') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Select End Date">Select End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control"
                                                value="{{ Request::get('end_date') }}">
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <div class="form-label-group">
                                                {{ Form::label('company_id', 'Select Company *') }}
                                                {{ Form::select('company_id', [], Request::get('company_id'), ['class' => 'form-select', 'placeholder' => 'Select Company', 'id' => 'company_id']) }}
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary mb-1" name="submit" value="Search">
                                    <a class="btn btn-primary mb-1" href="{{ url('admin/dailyexpenses') }}">Reset</a>

                                </div>
                            </div>
                            {{ Form::close() }}

                            <div class="table-responsive">
                                <table class="table zero-configuration" id="tbl-datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Emplyee Name</th>
                                            <th>Expense Name</th>
                                            <th>Amount Paid</th>
                                            <th>Payment Mode</th>
                                            <th>Bank Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @if (isset($daily_expenses) && count($daily_expenses) > 0)
                                            @php $srno = 1; @endphp
                                            @foreach ($daily_expenses as $expenses)
                                                <tr>
                                                    <td>{{ $srno }}</td>
                                                    <td>{{ $expenses->employee_name ?? '-' }}</td>
                                                    <td>{{ $expenses->expenses_name ?? '-' }}</td>
                                                    <td>{{ $expenses->amount_paid ?? '-' }}</td>
                                                    @if ($expenses->payment_mode == 'cash')
                                                        <td>{{ $expenses->payment_mode ?? '-' }}
                                                        </td>
                                                    @else
                                                        <td>{{ $expenses->payment_mode . '/' . $expenses->payment_no_or_mode ?? '-' }}
                                                        </td>
                                                    @endif
                                                    <td>{{ 'jhbdsj' }}</td>

                                                    <td>{{ $expenses->dated ?? '-' }}</td>
                                                    <td><a class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to Delete this Entry ?')"
                                                            href="{{ route('admin.dailyexpenses.delete', ['id' => $expenses->dailyexpenses_id]) }}">Delete</a>
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

    <script></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                dateFormat: 'dd/mm/yyyy'
            });

            $('#tbl-datatable').DataTable();
        });

        jQuery(function($) {
            $("#payment").hide();
            $("#r1").click(function() {
                // alert('check');
                $("#pay_cash").hide();
                // $("#pay_cash").text("Cash");

                $("#payment").hide();
                $("#payment").val("");
            });
            $("#r2").click(function() {
                $("#pay_cash").show();
                $("#pay_cash").text("Cheque No");
                $("#payment").show();
                $("#payment").val("");
            });
            $("#r3").click(function() {
                $("#pay_cash").show();
                $("#pay_cash").text("Electronic Payment");
                $("#payment").show();
                $("#payment").val("");

            });

            var check_balance = $("#remain_balance").val();
            // alert(check_balance);
            if (check_balance == 0) {
                $("#product_form").hide();
            } else {
                $("#product_form").show();
            }

            $(document).on("change", "#amount_paid", function() {
                // alert('test');
                var amount_paid = parseInt($("#amount_paid").val());
                // alert(amount_paid);
                var remain_balance = parseInt($("#remain_balance").val());
                // alert(remain_balance+' '+amount_paid);
                if (amount_paid <= 0) {
                    alert("Amount Paid not in minus");

                } else if (amount_paid > remain_balance) {
                    // alert('test');
                    alert("Amount Paid cannot be greater than balance amount");
                    $("#amount_paid").val("");
                    // $("#amount_paid").focus();
                } else {
                    // alert('test');
                    return false;
                }


            });

        });

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                document.getElementById("amount_paid").value = "";
                alert('only enter numbers');
                $("#amount_paid").val("");
            }
            return true;
        }
    </script>
@endsection
