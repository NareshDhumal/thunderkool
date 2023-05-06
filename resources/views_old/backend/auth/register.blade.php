@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card-body">
                {{-- @if (session::has('error'))
                <p class="text-danger">{{session::get('error')}}</p>    
                @endif --}}

                <form action="{{route('register')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="firstname" class="form-label">First name</label>
                      <input type="text" name="fisrtname" class="form-control" id="firstname" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="lastname" class="form-label">lastname</label>
                      <input type="text" name="lastname" class="form-control" id="lastname">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="text" name="email"  class="form-control" id="email">
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password" name="password" class="form-control" id="password">
                      </div>
  
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
</div>
    
@endsection