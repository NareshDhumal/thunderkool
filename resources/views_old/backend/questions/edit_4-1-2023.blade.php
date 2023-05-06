@extends('backend.layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Edit Survey Questions </h3>
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
                        <h4 class="card-title">Edit Survey Questions</h4>
                        <p class="card-description">Edit Questions </p>
                        @include('backend.includes.errors') 
                        {{-- {{ dd($editdata->toarray()) }} --}}
                   
                             {!! Form::model($editdata, [
                                'method' => 'POST',
                                'url' => ['admin/question/update'],
                                'class' => 'form'
                            ]) !!}
                        @csrf
                        
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::hidden('question_id', $editdata->question_id) }}
                                        {{ Form::label('type', 'question') }}
                                        {{ Form::text('question', null, ['class' => 'form-control','required' => true, 'placeholder'=>'Enter question']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group" >
                                        {{ Form::label('type', 'type') }}
                                        {{ Form::select('type', ['text input' => 'Text Input', 'textarea' => 'Textarea', 'checkbox' => 'Checkboxes' ,'radio' => 'Radio Button' , 'rating' => 'Star Rating'], null, ['class' => 'form-control', 'id' => 'questiontype', 'placeholder' => 'Select Question Type', 'required' => true]) }}
                                    </div>
                                </div>
                            </div>
                   
                            
                            {{-- <div class="row" id="test2">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('type', 'Enter Options') }}
                                        {{ Form::text('numofquestions', null, ['class' => 'form-control','required' => true, 'id' => 'no_of_questions' ,'placeholder'=>'Enter number of question']) }}
                                    </div>
                                </div> 
                            </div> --}}
                            @if ($editdata->type  == 'checkbox' || $editdata->type == 'radio') 
                            <div class="row" id="hide_question_feild">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('type', 'How Many Options Do You Want') }}
                                        {{ Form::text('numofquestions', null, ['class' => 'form-control','required' => true, 'id' => 'no_of_questions' ,'placeholder'=>'Enter number of question']) }}
                                    </div>
                                </div> 
                            </div>
                        
                             @endif
                            
                         
                             @foreach ($editdata->options as $data) 
                           
                             @for ($i = 1 ; $i <= count($editdata->options) ; $i++)

                             @endfor
                             <div class="cart-title"><label>@php $i @endphp Options</label></div>

                             {{-- <div class="cart-title"><label> Options</label></div> --}}
                              <div class="col-sm-12 question-data card-header"></div>
                              <div class="col-sm-12 question-data card-body">
                              <div class="row">
                              <div class="col-sm-3 question_box-field">
                              <input type="hidden" name="option_id" value="{{ $data->option_id }}">
                              <input type="text" name="option[]"  id="option_1" class="form-control option_text" value="{{ $data->options }}" placeholder="Enter Option">
                              </div>
                              </div>
                              </div>
                           
                             @endforeach
                          

                            <div class="access_data"></div>
                            
                            <div class="col md-12">
                                {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1', 'id' => 'butsave']) }}
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
        $('.test3').hide();

        $('#questiontype').on('change', function(){
        const selected_option = $('#questiontype').val();
            if (selected_option == 'checkbox') {
        $("#test2").show();
            }else if (selected_option == 'radio'){
        $("#test2").show();
            }else if(selected_option == 'rating'){
                 $('.test3').show();
            }else if(selected_option == 'normal question'){
        $("#test2").hide();
        $(".main_div").hide();

            }       
            });

   
               

            // var x = "<?php "$editdata->type" ?>";
            // if (x  == 'checkbox') {
             


            //  }
    // });






$('#no_of_questions').on('change', function(){

var requested = parseInt($("#no_of_questions").val(),10);

var count = 0;

if (requested > count) {
    var number_of_questions=parseInt(requested)-parseInt(count);
   var data='';
   for(var i=1;i<=number_of_questions;i++){
    // data +='<div class="main_div row"><div class="cart-title"><label>'+(i+1)+') Question</label></div><div class="col-sm-12 question-data card-header"><input type="text" name="question[]" class="form-control" placeholder="Enter Question" required></div>';
  
    data +='<div class="main_div row"><div class="cart-title"><label>'+(i+1)+') Options</label></div><div class="col-sm-12 question-data card-header"></div>';
    data+='<div class="col-sm-12 question-data card-header"></div>';



   data+='<div class="col-sm-12 question-data card-body"><div class="row">';
   data+='<div class="col-sm-3 question_box-field">';
   data+='<input type="text" name="option[]"  id="option_1" class="form-control option_text" placeholder="Enter Option" required></div>';

   data+='</div></div>';
   data+='</div>';
   }
   console.log(data);
   $(".access_data").append(data);
}
else if (requested < count) {

$('.main_div').slice(requested).remove();

}
});






// $.ajax({
//            url:'admin/question/store',
//            method:'POST',
//            data:data,
//            success:function(response){
//               if(response.success){
//                   alert(response.message) //Message come from controller
//               }else{
//                   alert("Error")
//               }
//            },
//            error:function(error){
//               console.log(error)
//            }
//         });




    });

    
</script>

