<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Feedback Form</title>

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="{{ asset('public/frontend/static/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontend/static/css/style.css') }}" />
</head>

<body>
    <div class="text-center">
        <a href="#" id="start_btn" class="btn btn-lg btn-primary" data-toggle="modal"
            data-target="#largeModal">Click to open Modal</a>
    </div>
    <!-- large modal -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg feedback-modal">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="feedback-logo">
                        <img src="{{ asset('public/frontend/static/images/jm-main-logo.svg') }}" />
                    </div>
                    <div class="feedback-form">
                        <form id="feed_back_form">
                            <!-- First Slide -->
                            <label id="feedback_form_0" class="is-visible">
                                <img class="newpaper-img img-fluid"
                                    src="{{ asset('public/frontend/static/images/icons/newspaper.png') }}" />
                                <label class="label-heading" for="feedback_form_0">What do you think of our monthly
                                    newsletter?</label>
                                <p class="label-subheading">
                                    Give us your feedback and help us improve
                                </p>
                                {{-- <input name="first" type="text" value="test" placeholder="name" required /> --}}
                                <div class="nav-btn-div">
                                    <div class="nav-first-div">
                                        <button type="button" id="first_btn" class="nav-button" value="next"
                                            onclick="emptynext('feedback_form_0','feedback_form_1')">
                                            Start
                                            <!-- <i class="fa fa-check" aria-hidden="true"></i> -->
                                        </button>
                                    </div>
                                    <div class="nav-second-div">
                                        <p>
                                            Press Enter
                                            <img class="img-fluid"
                                                src="{{ asset('public/frontend/static/images/enter.png') }}" />
                                        </p>
                                    </div>
                                </div>

                                <div class="arrow-div">
                                    <i class="fa fa-angle-right" onclick="next('feedback_form_0','feedback_form_1')"></i>
                                </div>
                            </label>
                            <!-- End First Slide -->
                            <div id="feedback_form_response"> </div>
                            

                            <p id="validate"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="stage2"></div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('public/frontend/static/js/bootstrap.bundle.js') }}"></script>
    <script>
        const stars = document.querySelectorAll(".rating-stars input");
        stars.forEach((star) => {
            console.log(star);
        });
        let error = document.getElementById("validate");
        let label = document.getElementsByTagName("label");

        document.getElementById("feedback_form_0").addEventListener("keyup", function(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                emptynext("feedback_form_0", "feedback_form_1");
            }
        });

        // document.getElementById("feedback_form_").addEventListener("keyup", function(e) {
        //     if (e.keyCode === 13) {
        //         e.preventDefault();
        //         next("feedback_form_1", "third");
        //     }
        // });

        // document.getElementById("third").addEventListener("keyup", function(e) {
        //     if (e.keyCode === 13) {
        //         e.preventDefault();
        //         next("third", "fourth");
        //     }
        // });
        // document.getElementById("fourth").addEventListener("keyup", function(e) {
        //     if (e.keyCode === 13) {
        //         e.preventDefault();
        //         emptynext("fourth", "fifth");
        //     }
        // });
        // document.getElementById("fifth").addEventListener("keyup", function(e) {
        //     if (e.keyCode === 13) {
        //         e.preventDefault();
        //         next("fifth", "sixth");
        //     }
        // });

        // document.getElementById("sixth").addEventListener("keyup", function(e) {
        //     if (e.keyCode === 13) {
        //         e.preventDefault();
        //         next("sixth", "seventh");
        //     }
        // });
        // document
        //     .getElementById("seventh")
        //     .addEventListener("keyup", function(e) {
        //         if (e.keyCode === 13) {
        //             e.preventDefault();
        //             next("seventh", "eighth");
        //         }
        //     });

        function next(from, to) {
            error.innerHTML = "";
            let value = document.getElementById(from).children[1].value;
            console.log(document.getElementById(from));
            console.log(value);
            // if (!value || value === "") {
            //     error.innerHTML = "Please enter a value";
            // } else {
            //     error.innerHTML = "";
                document.getElementById(from).classList.remove("is-visible");
                document.getElementById(to).classList.add("is-visible");
            // }
        }

        function emptynext(from, to) {
            error.innerHTML = "";
            let value = document.getElementById(from).children[1].value;
            document.getElementById(from).classList.remove("is-visible");
            document.getElementById(to).classList.add("is-visible");
        }

        function previous(from, to) {
            error.innerHTML = "";
            document.getElementById(to).classList.remove("is-visible");
            document.getElementById(from).classList.add("is-visible");
        }

        $('#start_btn').click(function() {

            let select_val = $(this).val();
            var csrfName = '<?= csrf_token() ?>';
            $.ajax({
                type: "post",
                url: "{{ url('/') }}/stepdata",
                // data: select_val,
                data: {
                    _token: csrfName,
                    select_val: select_val
                },
                // dataType: "dataType",
                success: function(response) {
                    // var test = response.question;
                    // alert(response);
                    $('#first_btn').click(function() {
                        // $(".first_question").html(response[0]);
                        // $(".second_question").html(response[1]);
                        // $(".third_question").html(response[1]);
                        // $(".fourth_question").html(response[1]);
                        // const cars = [response];
                        // var text = "";
                        // for (let i = 0; i < cars.length; i++) {
                        //   text += cars[i] + "<br>";
                        // }
                        // console.log(text);
                    });
                    $("#feedback_form_response").html(response[0]);
                    for(var i =1 ; i <= response[1]; i++)
                    {
                        var currele = "feedback_form_"+i;
                        $(document).on("keyup",currele, function(e) {
                            if (e.keyCode === 13) {
                                e.preventDefault();
                                next("feedback_form_"+i, "feedback_form_"+(i+1));
                            }
                        });
                    }
                }
            });
        });
        $(document).on('click',".rating-stars input",function()
        {
            $("#star_result").val($(this).val());
            console.log($(this));
        });
        $(document).on('click',"#submit_feedback",function()
        {
            var fields = $("#feed_back_form").serializeArray();
            var ccc = new FormData();
            console.log(fields);
            $.each(fields, function(i, field){
                ccc.append(field.name, field.value);
                console.log(ccc);
            });
            console.log(ccc);
            var csrfName = '<?= csrf_token() ?>';
            var formstr = $("#feed_back_form").serializeArray();
            // var postData = new FormData();
            // $.each(formstr, function(i, val) {
            //     postData.append(val.name, val.value);
            // });
            $.ajax({
                type: "post",
                url: "{{ url('/') }}/stepform/store",
                // data: select_val,
                data: {
                    _token: csrfName,
                    feedback_data: formstr,
                },
                // dataType: "dataType",
                success: function(response) {
                    // alert(response);
                    $("#feedback_form_response1").html(response[0]);
                }
            });
        });
    </script>
</body>

</html>
