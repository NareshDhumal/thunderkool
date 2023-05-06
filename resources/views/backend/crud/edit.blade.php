@extends('layouts.app')
@section('title', 'Edit Questions')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Edit Question</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                    

                     

                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <a class="btn btn-outline-primary" href="">
                        <i class="feather icon-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            {{ Form::open(['url' => '/question/update/'.$editdata->question_id]) }}
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
                                        <div class="form-group">
                                            {{ Form::label('type', 'type') }}
                                            {{ Form::text('type', null, ['class' => 'form-control','required' => true, 'placeholder'=>'Enter type']) }}
                                        </div>
                                    </div>
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
    </section>

    <script>
        $(document).ready(function() {
            $(function() {
                $("#dob").datepicker();
            });
        });
    </script>

@endsection
