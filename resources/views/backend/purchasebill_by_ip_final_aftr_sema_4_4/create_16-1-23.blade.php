@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')

  <div class="content">
   
<div class="row">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
{{-- {{ dd($editdata) }} --}}
                      {{-- Add Products Button --}}
                      <div class="d-flex">
                        {!! Form::button('Add Products', ['type' => 'submit', 'class' => 'btn btn-danger', 'id' => 'add_btn']) !!}
                        <button id="remove-btn" class="btn btn-danger ms-4" onclick="$(this).parents('#product_form').remove()">Remove</button>
                      </div>

      <h4 class="card-title">Purchase bill</h4>
      <p class="card-description">Purchase bill </p>
     
               @include('backend.includes.errors') 
                {{ Form::open(array('url' => 'admin/purchase/bill/store')) }}
                @csrf
                  <div class="form-body">
                    <div class="row">                   
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{-- {{ Form::text('supplier_id',  $supplier->supplier_id)}} --}}

                          {{ Form::label('supplier_id', 'Select Supplier *') }}
                          {{ Form::Select('supplier_id',$supplier, ['class' => 'form-control supplier_select', 'placeholder' => 'Select Supplier', 'id' => 'yourid' , 'required' => true]) }}
                        </div>
                      </div>

                      {{-- for bank deatils --}}
                      <table class="table table-bordered">
                      <tr style="width:100">
                        <th>Supplier Details</th>
                      </tr>
                      <tr>
                        <td style="width:50%;white-space:break-spaces;" class="Supplier_details"></td>
                        <td style="width:50%;white-space:break-spaces;" class="bank_details"></td>
                      </tr>
                      </table>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('company_id', 'Select Comapny *') }}
                          {{ Form::Select('company_id',$comapany,['class' => 'form-control', 'placeholder' => 'Select Company', 'required' => true]) }}
                        </div>
                      </div>

                       {{-- for company details --}}
                       <table class="table table-bordered">
                        <tr style="width:100">
                          <th>Company Details</th>
                        </tr>
                        <tr>
                          <td style="width:50%;white-space:break-spaces;" class="company_details"></td>
                          <td style="width:50%;white-space:break-spaces;" class="company_bank_details"></td>
                        </tr>
                       </table>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('supplier_bill_no', 'Supplier Bill No *') }}
                          {{ Form::text('supplier_bill_no', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('dated', ' Dated *') }}
                          {{ Form::date('dated', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                        </div>
                      </div>

                   

                      {{-- payment mode --}}
                      {{-- <div class="col-md-6 col-6">
                        {{ Form::label('payment', 'Payments *') }}
                        <fieldset>
                          <div class="radio radio-success">
                            {{ Form::label('cash', 'Cash') }}
                            {{ Form::radio('radio_status','cash',true,['id'=>'radioyes']) }}
                          </div>
                        </fieldset>
                        <fieldset>
                          <div class="radio radio-danger">
                            {{ Form::label('cheque_no', 'Cheque') }}
                            {{ Form::radio('radio_status','Cheque',true,['id'=>'radiohide']) }}
                          </div>
                        </fieldset>
                        <fieldset>
                          <div class="radio radio-danger">
                            {{ Form::label('electronic_transaction', 'Electronic Transaction ') }}
                            {{ Form::radio('radio_status','electronic_transaction',true,['id'=>'radiono']) }}
                          </div>
                        </fieldset>
                      </div>
                      <div></div>
                       --}}

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('payment_mode', 'Payment Mode *') }}
                          {{ Form::Select('payment_mode',$payment_mode,['class' => 'form-control payment_mode', 'placeholder' => 'Select Company', 'required' => true]) }}
                        </div>
                      </div>
                       
                      {{-- <input type="radio" name="payment_mode" value="cash" id="cash"> Cash
                      <input type="radio" name="payment_mode" value="cheque" id="cheque">Cheque
                      <input type="radio" name="payment_mode" value="epayment" id="epayment">Electronic Transaction --}}

                      <div id="payment_m">
                        <input type="text" name="cheque_no" placeholder="Cheque No">
                      </div>
                      <div id="bank_name">
                        <input type="text" name="bank_name" placeholder="Bank Name">
                      </div>
                      <div id="cheque_date">
                        <input type="date" name="cheque_date" placeholder="Bank Name">
                      </div>
                      <div id="payment_electronic_ref">
                        <input type="text" name="electronic_payment_ref" placeholder="Payment Reference">
                      </div>
                 
                     
                      <div class="repeater">
                        <div class="form-row">
                       <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('product_name', 'Description *') }}
                          {{ Form::select('product_name',$products, null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('hsn_code', 'Hsn Code *') }}
                          {{ Form::text('hsn_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) }}
                        </div>
                      </div>
          
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('p_part_no', 'Company Port No *') }}
                          {{ Form::text('p_part_no', null,  ['class' => 'form-control', 'placeholder' => 'Enter Password']) }}
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('p_custom_port_no', 'Custom Port No *') }}
                          {{ Form::text('p_custom_port_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('quantity', ' Quentity *') }}
                          {{ Form::text('quantity', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('product_unit', 'product unit *') }}
                          {{ Form::text('product_unit', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('amount', 'Amount *') }}
                          {{ Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('cgst_percent', 'Gst % *') }}
                          {{ Form::select('cgst_percent', $gst_percent, null, ['class' => 'form-control', 'placeholder' => 'Enter Gst Percentage']) }}
                        </div>
                      </div>
                      {{-- amount which is coming by calculateing Percantage of gst and product price --}}
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('total_amount', 'Total Amount*') }}
                          {{ Form::text('total_amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password', 'id' => 'quantity2']) }}
                        </div>
                      </div>

                    </div>

                    {{-- <div class="col-md-6 col-12">
                      <div class="form-label-group">
                        {{ Form::label('score', 'Gst Amount*') }}
                        {{ Form::text('score', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password', 'id' => 'quantity_img2']) }}
                      </div>
                    </div> --}}



                    {{-- readonly inputs --}}
<td width="80">Quantity<input type="text" class="form-control" name="finalquantity" value="" readonly="readonly"></td>
<td>Amount<input type="text" class="form-control" name="finalamount" value="" readonly="readonly"></td>

<!-- <td width="90">IGST<input type="text" class="form-control" name="finaligstamount" value="" readonly="readonly"></td> -->


<td width="180">Total Amount<input type="text" class="form-control finalgstamount"  name="finalgstamount" value="" readonly="readonly"></td>
</tr>

<tr>
<td colspan="12" align="right">Total Amount (Without GST)</td>
<td><input type="text" class="form-control" name="total_without_tax" value="" id="total_without_tax" readonly="readonly"></td>
</tr>
<tr>
<td colspan="12" align="right">GST Amount</td>
<td><input type="text" class="form-control" name="final_igst_amount" value="" id="gst_amount" readonly="readonly"></td>
</tr>
<tr>
<td colspan="12" align="right">Grand Total ( With GST )</td>
<td><input type="text" class="form-control" name="grand_total_gst" value="" id="grand_total_gst" readonly="readonly"></td>
</tr>


<tr>
<td colspan="15" align="left">Amount Chargeable ( in Words )<br />
<br /><input type="text" class="form-control" name="amount_words" value="Nill" id="amount_words" readonly="readonly"></td>
</tr>


                      <div class="col-12 d-flex justify-content-start">
                        {{ Form::submit('Save', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                        <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                      </div>
                    </div>
                    </div>
                  </div>
                  
                  {{-- <div class="form-group col-md-1">
                    <button type="button" class="btn btn-success" onclick="addFormElements()">Add</button>
                  </div>
                  <div class="form-group col-md-1">
                    <button type="button" class="btn btn-danger" onclick="removeFormElements()">Remove</button>
                  </div> --}}
                {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
      </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
      integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
      crossorigin="anonymous"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script> --}}
<script>
//   function addFormElements(current) {
//     $(current).parents('.product_form').append($(current).parents('.form-row').clone())
// }

// function removeFormElements(current) {
//     $(current).parents('.form-row').remove();
// }
    $(document).ready(function(){
          // $('.product_form').hide()
          $('.repeater').hide()

          jQuery('#add_btn').on('click',function(){
            console.log('ok');
            $(function(){
	          $("#repeater").createRepeater();
            });
              // jQuery('.product_form').toggle();
            });


            // $('#supplier_id').select2();
            // $('#company_id').select2();
//repeter
// $(".product_form").repeater({
      
//       show: function() {
//          $(this).slideDown();
//       },

//       hide: function(deleteElement) {
//          if (confirm("Are you sure you want to delete this element?")) {
//             $(this).slideUp(deleteElement);
//          }
//       },

//       ready: function(setIndexes) {
//          //$dragAndDrop.on('drop', setIndexes);
//       },
//       repeaters: [
//          {
//             selector: ".product_form"
//          }
//       ]
//    });





// payment mode
$('#payment_m').hide();
$('#bank_name').hide();
$('#cheque_date').hide();
$('#payment_electronic_ref').hide();

$('#payment_mode').change(function(){
    // alert($(this).text());
  //  alert($("#payment_mode :selected").text())
                if($("#payment_mode :selected").text() == "cheque"){

                  $('#payment_m').show();
                  $('#bank_name').show();
                  $('#cheque_date').show();
                  $('#payment_electronic_ref').hide();


                }else if($("#payment_mode :selected").text() == "Epayment"){

                  $('#payment_electronic_ref').show();
                  $('#bank_name').hide();
                  $('#cheque_date').hide();
                  $('#payment_m').hide();

                }else if($("#payment_mode :selected").text() == "cash"){

                  $('#payment_m').hide();
                  $('#bank_name').hide();
                  $('#cheque_date').hide();
                  $('#payment_electronic_ref').hide();

                }
});


//imp
// $("#quantity2").keyup(function () {
//       var value = $(this).val();
//       $("#quantity_img2").val(value);
//     }).keyup();


//     function myFunction() {
//   var x = document.getElementById("mySelect").value;
  // document.getElementById("demo").innerHTML = "You selected: " + x;
// }

$('#company_id').change(function() {
let select_val = $(this).val();  
// alert(select_val);

var csrfName = '<?= csrf_token() ?>';
// alert(select_val);
$.ajax({
  type: "post",
  url: "{{ url('/') }}/admin/purchase/bill/companydetails",
  // data: select_val,
  data: {
                _token:csrfName,
                select_val:select_val
            },
  // dataType: "dataType",
  success: function (response) {
 $(".company_details").html(response[0]);
 $(".company_bank_details").html(response[1]);
  }
});
});



$('#supplier_id').change(function() {
let select_val = $(this).val();  
var csrfName = '<?= csrf_token() ?>';
// alert(select_val);
$.ajax({
  type: "post",
  url: "{{ url('/') }}/admin/purchase/bill/suppllierdetails",
  // data: select_val,
  data: {
                _token:csrfName,
                select_val:select_val
            },
  // dataType: "dataType",
  success: function (response) {
 $(".Supplier_details").html(response[0]);
 $(".bank_details").html(response[1]);
  }
});
});
    });
</script>
@endsection
