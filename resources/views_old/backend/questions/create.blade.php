@extends('backend.layouts.app')

@section('content')
    <div class="content">


        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title page-title">Create Feedback Questions</h4>
                        <p class="card-description">Create Questions </p>
                        @include('backend.includes.errors')
                        {{ Form::open(['url' => 'admin/question/store']) }}
                        @csrf

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('type', 'question') }}
                                        {{ Form::text('question', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Enter question']) }}
                                    </div>
                                </div>
                            {{-- </div>
                            <div class="row"> --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('type', 'type') }}
                                        {{ Form::select('type', ['text input' => 'Text Input', 'textarea' => 'Textarea', 'checkbox' => 'Checkboxes', 'radio' => 'Radio Button', 'Star Rating' => 'Star Rating'], null, ['class' => 'form-control', 'id' => 'questiontype', 'placeholder' => 'Select Question Type', 'required' => true]) }}
                                    </div>
                                </div>
                            </div>


                            {{-- star rating --}}
                            {{-- <div class="col test3">
                                <div class="rate">
                                   <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                   <label for="star5" title="text">5 stars</label>
                                   <input type="radio" checked id="star4" class="rate" name="rating" value="4"/>
                                   <label for="star4" title="text">4 stars</label>
                                   <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                   <label for="star3" title="text">3 stars</label>
                                   <input type="radio" id="star2" class="rate" name="rating" value="2">
                                   <label for="star2" title="text">2 stars</label>
                                   <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                   <label for="star1" title="text">1 star</label>
                                </div>
                             </div> --}}



                            {{-- number of Options --}}
                            <div class="row" id="no_of_questions_div">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('type', 'How Many Options Do You Want') }}
                                        {{ Form::text('numofquestions', null, ['class' => 'form-control', 'id' => 'no_of_questions', 'placeholder' => 'Enter number of question']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="access_data row"> </div>

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
@endsection
<script src="https://code.jquery.com/jquery-3.6.2.min.js"
    integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#no_of_questions_div').hide();
        $('.test3').hide();



        // $('#questiontype').on('change', function(){
        //     const selected_option = $('#questiontype').val();
        //         if (selected_option == 'checkbox') {
        //     $("#no_of_questions_div").show();

        //         }else if (selected_option == 'radio'){
        //     $("#no_of_questions_div").show();

        //         }else if(selected_option == 'Star Rating'){

        //     // $('.test3').show();
        //     $("#no_of_questions_div").remove();
        //     $("#option_1").removeAttr('required');

        //     $(".main_div").hide();

        //         }else if(selected_option == 'text input'){
        //     $("#no_of_questions_div").remove();
        //     $("#option_1").removeAttr('required');

        //     $(".main_div").hide();

        //         }else if(selected_option == 'textarea'){
        //     $("#no_of_questions_div").remove();
        //     $("#option_1").removeAttr('required');

        //     $(".main_div").hide();

        //         }
        // });

        $('#questiontype').on('change', function() {
            const selected_option = $('#questiontype').val();
            $(".access_data").html('');
            console.log('clear 1');
            if (selected_option == 'checkbox') {
                $("#no_of_questions_div").show();
                $(".main_div").show();
                $('#no_of_questions').trigger('change');
            } else if (selected_option == 'radio') {
                $("#no_of_questions_div").show();
                $(".main_div").show();
                $('#no_of_questions').trigger('change');

            } else if (selected_option == 'Star Rating') {
                // $('#no_of_questions').removeAttr('required');

                // $('.test3').hide();
                // // $("#no_of_questions_div").remove();
                // // $("#option_1").removeAttr('required');
                // $(".main_div").hide();
                $('#no_of_questions').removeAttr('required');
                $("#no_of_questions_div").hide();
                $(".main_div").hide();

            } else if (selected_option == 'text input') {
                $('#no_of_questions').removeAttr('required');
                $("#no_of_questions_div").hide();
                $(".main_div").hide();

            } else if (selected_option == 'textarea') {
                $('#no_of_questions').removeAttr('required');
                $("#no_of_questions_div").hide();
                $(".main_div").hide();

            }
        });




        $('#no_of_questions').on('change', function() {

            var requested = parseInt($("#no_of_questions").val(), 10);
            var select_val = $('.option_text').length;
            console.log(select_val);
            var count = 0;

            if (requested > select_val) {
                var number_of_questions = parseInt(requested) - parseInt(count);
                var data = '';
                for (var i = select_val; i < number_of_questions; i++) {
                    data += '<div class="col-sm-6 main_div question_box-field">';
                    data +=
                        '<label>' + (i + 1) +
                        ') Option</label><input type="text" name="option[]"  id="option_1" class="form-control option_text" placeholder="Enter Option" required>';
                    data += '</div>';
                }
                console.log(data);
                $(".access_data").append(data);
            } else if (requested < select_val) {
                console.log(requested);
                console.log(select_val);
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










































{{-- // $(function() {

    // var input = $('<input type="text" />');
    // var newFields = $('');
    
    // $('#no_of_questions').bind('blur keyup change', function() {
    //     var n = this.value || 0;
    //     if (n+1) {
    //         if (n > newFields.length) {
    //             addFields(n);
    //         } else {
    //             removeFields(n);
    //         }
    //     }
    // });
    
    // function addFields(n) {
    //     for (i = newFields.length; i < n; i++) {
    //         var newInput = input.clone();
    //         newFields = newFields.add(newInput);
    //         newInput.appendTo('.access_data');
    //     }
    // }
    
    // function removeFields(n) {
    //     var removeField = newFields.slice(n).remove();
    //     newFields = newFields.not(removeField);
    // }
    // }); --}}






// {{-- data+='<div class="col-sm-12 question-data card-body"><div class="row">';
//     data+='<div class="col-sm-3 question_box-field">';
//     data+='<input type="text" name="option_1[]" class="form-control option_text" placeholder="Enter Option" required></div>';
//     data+='<div class="col-sm-3 question_box-field">';
//     data+='<input type="radio" name="answer['+i+']" value="2" class="answer_option" required><input type="text" name="option_2[]" class="form-control option_text" placeholder="Enter Option" required></div>';
//     data+='<div class="col-sm-3 question_box-field">';
//     data+='<input type="radio" name="answer['+i+']" value="3" class="answer_option" required><input type="text" name="option_3[]" class="form-control option_text" placeholder="Enter Option" required></div>';
//     data+='<div class="col-sm-3 question_box-field">';
//     data+='<input type="radio" name="answer['+i+']" value="4" class="answer_option" required><input type="text" name="option_4[]" class="form-control option_text" placeholder="Enter Option" required></div>';
//     data+='</div></div>';
//     data+='</div>'; --}}
