@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create User') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('user.store')}}" method="POST">
                        @csrf
                        <fieldset>
                        <legend>Please Enter Your Information</legend>
                        <div class="form-group">
                            <label for="name" class="form-label mt-4">Name</label>
                            <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter username:">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="email" class="form-label mt-4">Email</label>
                            <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email:">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-danger">Create</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
