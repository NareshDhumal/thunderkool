@extends('backend.layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Create Survey Questions </h3>
        <nav aria-label="breadcrumb">
          <div class="card-header">
            <a href="{{ route('admin.index') }}" class="btn btn-btn-primary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
          </div>
          {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashbord</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashbord</li>
          </ol> --}}
        </nav>
      </div>
  <div class="row">
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Create Survey Questions</h4>
        <p class="card-description">Create Questions </p>
                 @include('backend.includes.errors') 

                            {{ Form::open(['url' => '/question/create']) }}
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            {{ Form::label('type', 'question') }}
                                            {{ Form::text('question', null, ['class' => 'form-control','required' => true, 'placeholder'=>'Enter question']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group" >
                                            {{ Form::label('type', 'type') }}
                                            {{ Form::select('type', ['normal question' => 'normal question', 'textarea' => 'textarea', 'checkbox' => 'checkbox'], null, ['class' => 'form-control', 'id' => 'questiontype', 'placeholder' => 'Select Question Type', 'required' => true]) }}
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row" id="test2">
                                <div class="col-md-6 col-12">
                                        <div class="form-group" >
                                        {{ Form::label('select', 'Pls select how many chekbox do you want') }}
                                        {{ Form::select('select', ['1' => '1', '2' => '2', '3' => '3', '4' =>'4'], null, ['class' => 'form-control', 'id' => 'test2' , 'placeholder' => 'select the number', 'required' => true]) }}
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row" id="test2">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            {{ Form::label('type', 'question') }}
                                            {{ Form::text('how many questions do u want', null, ['class' => 'form-control','required' => true, 'id' => 'no_of_questions' ,'placeholder'=>'Enter number of question']) }}
                                        </div>
                                    </div> 
                                </div>

                              <div class="access_data">

                              </div>


                                
                                    <div class="col md-12">
                                        {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                        <button type="reset" class="btn btn-dark mr-1 mb-1">Reset</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
     @endsection
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#test2').hide();

       

    $('#questiontype').on('change', function(){
        const selected_option = $('#questiontype').val();
            if (selected_option == 'checkbox') {
        $("#test2").show();
            }
    });






$('#no_of_questions').on('change', function(){

var requested = parseInt($("#no_of_questions").val(),10);
var count = 0;

if (requested > count) {
    var number_of_questions=parseInt(requested)-parseInt(count);
   var data='';
   for(var i=0;i<number_of_questions;i++){
   data +='<div class="main_div row"><div class="cart-title"><label>'+(i+1)+')</label></div><div class="col-sm-9 question-data card-header"><input type="text" name="question[]" class="form-control" placeholder="Enter Question" required></div>';
   data+='<div class="col-sm-3 question-data card-body question-last--field">';
   data+='<input type="text" name="question_marks[]" value="10" class="form-control" placeholder="Enter Marks For Question" required></div>';


   data+='<div class="col-sm-12 question-data card-body"><div class="row">';
   data+='<div class="col-sm-3 question_box-field">';
   data+='<input type="radio" name="answer['+i+']" value="1" class="answer_option" required><input type="text" name="option_1[]" class="form-control option_text" placeholder="Enter Option" required></div>';
   data+='<div class="col-sm-3 question_box-field">';
   data+='<input type="radio" name="answer['+i+']" value="2" class="answer_option" required><input type="text" name="option_2[]" class="form-control option_text" placeholder="Enter Option" required></div>';
   data+='<div class="col-sm-3 question_box-field">';
   data+='<input type="radio" name="answer['+i+']" value="3" class="answer_option" required><input type="text" name="option_3[]" class="form-control option_text" placeholder="Enter Option" required></div>';
   data+='<div class="col-sm-3 question_box-field">';
   data+='<input type="radio" name="answer['+i+']" value="4" class="answer_option" required><input type="text" name="option_4[]" class="form-control option_text" placeholder="Enter Option" required></div>';
   data+='</div></div>';
   data+='</div>';
   }
   $(".access_data").append(data);
}
else if (requested < count) {

$('.main_div').slice(requested).remove();

}
});






















    });
    
</script>