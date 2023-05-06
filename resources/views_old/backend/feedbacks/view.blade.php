@extends('backend.layouts.app')

@section('content')
    <div class="content">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title page-title">View Feedback</h4>
                        <p class="card-description">View Feedback </p>

                        

                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table zero-configuration" id="tbl-datatable" style="white-space: nowrap;">
                                        <tbody>
                                            <tr><th>Name</th><td>{{ $feedback_form->feedback_name }}</td></tr>
                                            <tr><th>Email</th><td>{{ $feedback_form->feedback_email }}</td></tr>
                                            <tr><th>Phone</th><td>{{ $feedback_form->feedback_phone }}</td></tr>
                                       
                                            @if (isset($feedback_form->meta) && count($feedback_form->meta) > 0)
                                                @php $srno = 1; @endphp
                                                @foreach ($feedback_form->meta as $feedback_form_meta)
                                                    <tr><th>{{ $srno }}. {{ $feedback_form_meta->feedback_meta_question }}</th><td>{{ $feedback_form_meta->feedback_meta_value }}</td></tr>
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
