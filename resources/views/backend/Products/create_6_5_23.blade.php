@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Create Products</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.products') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title="Back"><i
                    class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->

    <div class="db-section admin-form">
        <div class="content">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title">Create Products</h4> --}}
                            {{-- <div class="text-end" style="position: absolute;
              right: 50px;">
                            <a href="{{ route('admin.products') }}" class="btn btn-inverse-danger btn-fw"><i
                                    class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                        </div> --}}
                            {{-- <p class="card-description">Create Products </p> --}}
                            @include('backend.includes.errors')
                            {{ Form::open(['url' => 'admin/products/store']) }}
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('product_name', 'product name *', ['class' => 'label_for_product_and_service']) }}
                                            {{ Form::text('product_name', null, [
                                                'class' => 'form-control',
                                                'id' => 'product_name',
                                                'placeholder' => 'Enter Product Name',
                                                'required' => true,
                                            ]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('company_name', 'company name *') }}
                                            {{ Form::select('company_id', $company, null, ['class' => 'form-select', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('service', 'select service or product*') }}
                                            {{ Form::select('service_id', ['0' => 'Select Service Or Poduct', '1' => 'Service', '2' => 'Product'], null, ['class' => 'form-select', 'id' => 'service', 'required' => true]) }}
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-12">
                                    <div class="form-label-group mb-5">
                                        {{ Form::label('product_code', 'product code *') }}
                                        {{ Form::text('product_code', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Last Name', 'required' => true]) }}
                                    </div>
                                </div> --}}

                                    <div class="col-md-6 col-12 service_hide">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('product_rate', 'product rate *') }}
                                            {{ Form::number('product_rate', null, ['class' => 'form-control', 'placeholder' => 'Enter Rate', 'id' => 'rate', 'min' => 0, 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 service_hide">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('product_stock', 'product qty *') }}
                                            {{ Form::number('product_stock', null, ['class' => 'form-control product_stock', 'placeholder' => 'Enter Stock', 'id' => 'stock', 'min' => 0, 'required' => true]) }}
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-12 service_hide">
                                    <div class="form-label-group mb-5">
                                        {{ Form::label('product_party', 'product party *') }}
                                        {{ Form::text('product_party', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Confirm Password']) }}
                                    </div>
                                </div> --}}

                                    <div class="col-md-6 col-12 service_hide">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('hsn_code', 'Hsn Code') }}
                                            {{ Form::number('hsn_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Hsn', 'id' => 'hsn', 'min' => 0]) }}
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-12 service_hide">
                                    <div class="form-label-group mb-5">
                                        {{ Form::label('sac_code', 'sac_code *') }}
                                        {{ Form::text('sac_code', null, ['class' => 'form-control', 'placeholder' => 'Enter
                                        Confirm Password']) }}
                                    </div>
                                </div> --}}

                                    {{-- <div class="col-md-6 col-12 service_hide">
                                    <div class="form-label-group mb-5">
                                        {{ Form::label('tax_percent', 'tax percent *') }}
                                        {{ Form::text('tax_percent', null, ['class' => 'form-control', 'placeholder' =>
                                        'Enter Confirm Password']) }}
                                    </div>
                                </div> --}}

                                    <div class="col-md-6 col-12 service_hide">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('product_part_no', 'product part no') }}
                                            {{ Form::number('product_part_no', null, ['class' => 'form-control product_part_no', 'placeholder' => 'Enter Part no', 'id' => 'part_no', 'min' => 0]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 service_hide">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('product_part_no_custom', 'product part no custom') }}
                                            {{ Form::number('product_part_no_custom', null, ['class' => 'form-control', 'placeholder' => 'Enter Custom Part No', 'id' => 'p_part_no', 'min' => 0]) }}
                                        </div>
                                    </div>



                                    <div class="col-md-6 col-12 service_hide">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('product_unit', 'product unit *') }}
                                            {{ Form::select('product_unit', $unit, null, ['class' => 'form-select', 'id' => 'product_unit', 'placeholder' => 'Select Unit', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 service_hide">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('gst_percent', 'gst percent *') }}
                                            {{ Form::select('gst_percent', $gst_percent, null, ['class' => 'form-select', 'id' => 'gst', 'placeholder' => 'Select Gst %', 'required' => true]) }}
                                        </div>
                                    </div>

                                    {{-- group --}}
                                    {{-- <div class="col-md-6 col-12 service_hide">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('group_id', 'Group Name *') }}
                                            {{ Form::select('group_id', $product_name, null, ['class' => 'form-select', 'id' => 'group']) }}
                                        </div>
                                    </div> --}}


                                    {{-- grams --}}
                                    {{-- <div class="col-md-6 col-12" id="Gram">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('Gram', 'Grams') }}
                                            {{ Form::text('grams', null, ['class' => 'form-control Grams', 'placeholder' => 'Enter Grams']) }}
                                        </div>
                                    </div>
                                     --}}
                                    {{-- liter --}}
                                    {{-- <div class="col-md-6 col-12" id="liter">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('liter', 'Liter') }}
                                            {{ Form::text('liter', null, ['class' => 'form-control liters', 'placeholder' => 'Enter liter']) }}
                                        </div>
                                    </div> --}}

                                    {{-- mil --}}
                                    {{-- <div class="col-md-6 col-12" id="mil">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('mil', 'mil') }}
                                            {{ Form::text('mil', null, ['class' => 'form-control mils', 'placeholder' => 'Enter liter']) }}
                                        </div>
                                    </div> --}}




                                    {{-- Kilogram --}}
                                    {{-- <div class="col-md-6 col-12" id="kilogram">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('kilogram', 'kilogram') }}
                                            {{ Form::text('kilogram', null, ['class' => 'form-control kilograms', 'placeholder' => 'Enter liter']) }}
                                        </div>
                                    </div> --}}


                                    <div class="col-12 d-flex justify-content-start">
                                        {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1 me-5']) }}
                                        <button type="reset" class="btn btn-primary mr-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#Gram').hide();
            $('#kilogram').hide();
            $('#liter').hide();
            $('#mil').hide();



            $('#product_unit').change(function() {
                if ($("#product_unit :selected").val() == "2") {

                    $('.product_stock').val('');
                    $('.product_stock').attr('readonly', true);

                    $('.kilograms').val('');
                    $('#kilogram').hide();


                    $('.liters').val('');
                    $('#liter').hide();

                    $('.mils').val('');
                    $('#mil').hide();


                    $('#Gram').show();

                } else if ($("#product_unit :selected").val() == "1") {

                    $('.product_stock').attr('readonly', false);

                    $('.Grams').val('');
                    $('#Gram').hide();

                    $('.liters').val('');
                    $('#liter').hide();

                    $('.kilograms').val('');
                    $('#kilogram').hide();

                    $('.mils').val('');
                    $('#mil').hide();

                } else if ($("#product_unit :selected").val() == "3") {

                    $('.product_stock').val('');
                    $('.product_stock').attr('readonly', true);
                    // $('.Grams').attr('readonly', false);
                    $('.Grams').val('');
                    $('#Gram').hide();

                    $('.kilograms').val('');
                    $('#kilogram').hide();

                    $('.liters').val('');
                    $('#liter').hide();

                    $('#mil').show();




                } else if ($("#product_unit :selected").val() == "4") {

                    $('.product_stock').val('');
                    $('.product_stock').attr('readonly', true);

                    $('.Grams').val('');
                    $('#Gram').hide();

                    $('.liters').val('');
                    $('#liter').hide();

                    $('.mils').val('');
                    $('#mil').hide();

                    $('#kilogram').show();


                } else if ($("#product_unit :selected").val() == "5") {

                    $('.product_stock').val('');
                    $('.product_stock').attr('readonly', true);

                    $('.Grams').val('');
                    $('#Gram').hide();

                    $('.mils').val('');
                    $('#mil').hide();

                    $('.kilograms').val('');
                    $('#kilogram').hide();

                    $('#liter').show();



                }

            })


            $('.product_part_no').change(function() {
                var unit = $(this).val();

                var csrfName = '<?= csrf_token() ?>';
                // alert(select_val);
                $.ajax({
                    type: "post",
                    url: "{{ url('/') }}/admin/product/partno",
                    // data: select_val,
                    data: {
                        _token: csrfName,
                        unit: unit
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        if (response[0] == '2') {
                            $("#product_unit option").prop('disabled', 'disabled');
                            $(`#product_unit option[value="2"]`).prop('disabled', false);
                            $(`#product_unit option[value="4"]`).prop('disabled', false);
                        } else if (response[0] == '3') {
                            $("#product_unit option").prop('disabled', 'disabled');
                            $(`#product_unit option[value="3"]`).prop('disabled', false);
                            $(`#product_unit option[value="5"]`).prop('disabled', false);
                        } else {
                            $("#product_unit option").prop('disabled', 'disabled');
                            $(`#product_unit option[value="1"]`).prop('disabled', false);
                        }
                        // dropdownElement.find('option[value='+response[0]+']').remove();

                        // dropdownElement.find(`option[value="${response}"]`).remove();



                    }
                });

            })

            $('#service').change(function() {

                var value = $(this).val();
                if (value == 1) {
                    $('.label_for_product_and_service').text('Service Name *');
                    $('#product_name').attr('placeholder', 'Enter Service Name');
                    $('#rate').val('');
                    $('#stock').val('');
                    $('#hsn').val('');
                    $('#part_no').val('');
                    $('#p_part_no').val('');
                    $('#product_unit').val('');
                    $('#gst').val('');
                    $('#group').val('');


                    $('.service_hide').hide();


                    
                } else if (value == 2) {
                    $('.label_for_product_and_service').text('Product Name *')
                    $('#product_name').attr('placeholder', 'Enter Product Name');


                    $('.service_hide').show();
                }


            });


        });
    </script>
@endsection
