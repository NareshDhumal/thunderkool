@extends('backend.layouts.app')

@section('content')
    <div class="content">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title page-title">Edit Survey Questions</h4>
                        <p class="card-description">Edit Questions </p>
                        @include('backend.includes.errors')
                        {{-- {{ dd($editdata->toarray()) }} --}}

                        {!! Form::model($editdata, [
                            'method' => 'POST',
                            'url' => ['admin/question/update'],
                            'class' => 'form',
                        ]) !!}
                        @csrf

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::hidden('question_id', $editdata->question_id) }}
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


                            {{-- <div class="row" id="no_of_questions_div">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('type', 'Enter Options') }}
                                        {{ Form::text('numofquestions', null, ['class' => 'form-control','required' => true, 'id' => 'no_of_questions' ,'placeholder'=>'Enter number of question']) }}
                                    </div>
                                </div> 
                            </div> --}}
                            <div class="row" id="no_of_questions_div">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        {{ Form::label('type', 'How Many Options Do You Want') }}
                                        {{ Form::text('numofquestions', null, ['class' => 'form-control', 'required' => true, 'id' => 'no_of_questions', 'placeholder' => 'Enter number of question']) }}
                                    </div>
                                </div>
                            </div>

                            
                            <div class="access_data row">
                                @if(isset($editdata->options) && count($editdata->options)>0)
                                @foreach ($editdata->options->sortBy('option_id') as $data)
                                    <div class="col-sm-6 main_div question_box-field">
                                        <label>Option {{ $loop->index+1 }} </label>
                                        <input type="text" name="option[{{ $loop->index }}]"  id="option_1" class="form-control option_text" placeholder="Enter Option" value="{{ $data->options }}" required>
                                         {{-- <input type="hidden" name="option_id" value="{{ $data->option_id }}"> --}}
                                        {{--<input type="text" name="option[]" id="option_1"
                                            class="form-control option_text" value="{{ $data->options }}"
                                            placeholder="Enter Option"> --}}
                                    </div>
                                @endforeach
                                @endif
                            </div>

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
        // $('#no_of_questions_div').hide();
        $('.test3').hide();

        // $('#questiontype').on('change', function() {
        //     const selected_option = $('#questiontype').val();
        //     if (selected_option == 'checkbox') {
        //         $("#no_of_questions_div").show();

        //     } else if (selected_option == 'radio') {
        //         $("#no_of_questions_div").show();

        //     } else if (selected_option == 'Star Rating') {
        //         //  $('.test3').show();
        //         $("#no_of_questions_div").hide();

        //     } else if (selected_option == 'text input') {
        //         $("#no_of_questions_div").hide();
        //         $(".main_div").hide();

        //     } else if (selected_option == 'textarea') {
        //         $("#no_of_questions_div").hide();
        //         $(".main_div").hide();

        //     }
        // });
        let selected_option_load = $('#questiontype').val();
        if(selected_option_load != "")
        {
            question_type_change('onload');
        }
        $('#questiontype').on('change', function() {
            question_type_change('onchange');
        });

        function question_type_change(changemode)
        {
            let selected_option = $('#questiontype').val();
            
            console.log('clear 1');
            console.log(selected_option);
            if (selected_option == 'checkbox') {
                $("#no_of_questions_div").show();
                $(".main_div").show();
                if(changemode == 'onchange')
                {
                    $('#no_of_questions').trigger('change');
                }
            } else if (selected_option == 'radio') {
                $("#no_of_questions_div").show();
                $(".main_div").show();
                if(changemode == 'onchange')
                {
                    $('#no_of_questions').trigger('change');
                }

            } else if (selected_option == 'Star Rating') {
                $('#no_of_questions').removeAttr('required');

                $('.test3').hide();
                // $("#no_of_questions_div").remove();
                // $("#option_1").removeAttr('required');
                $(".main_div").hide();

            } else if (selected_option == 'text input') {
                $('#no_of_questions').removeAttr('required');
                $("#no_of_questions_div").hide();
                $(".main_div").hide();
                $(".access_data").html('');

            } else if (selected_option == 'textarea') {
                $('#no_of_questions').removeAttr('required');
                $("#no_of_questions_div").hide();
                $(".main_div").hide();
                $(".access_data").html('');
            }
        }
        $('#no_of_questions').on('change', function() {

            var requested = parseInt($("#no_of_questions").val(), 10);
            var select_val = $('.option_text').length;
            var count = 0;
            if (requested > select_val) {
                var number_of_questions = parseInt(requested) - parseInt(count);
                var data = '';
                for (var i = select_val; i < number_of_questions; i++) {
                    data += '<div class="col-sm-6 main_div question_box-field">';
                    data +=
                        '<label>' + (i + 1) +
                        ') Option</label><input type="text" name="option['+ (i) +']"  id="option_1" class="form-control option_text" placeholder="Enter Option" required>';
                    data += '</div>';
                }
                // console.log(data);
                $(".access_data").append(data);
            } else if (requested < select_val) {

                $('.main_div').slice(requested).remove();

            }
        });

    });
</script>
