@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Settings</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('settings.update2')}}" method="POST">
                        @csrf
                        {{method_field('PATCH')}}
                        <fieldset>
                        <legend>Please Edit the settings</legend>
                        <div class="form-group">
                            <label for="blog_name" class="form-label mt-4">Blog Name</label>
                            <input value="{{$setting->blog_name}}" name="blog_name" type="text" class="form-control" id="blog_name" aria-describedby="emailHelp" placeholder="Enter name:">
                        </div>
                        <div class="form-group">
                            <label for="phone_number" class="form-label mt-4">Phone Number</label>
                            <input value="{{$setting->phone_number}}" name="phone_number" type="text" class="form-control" id="blog_name" aria-describedby="emailHelp" placeholder="Enter phone number:">
                        </div>
                        <div class="form-group">
                            <label for="blog_email" class="form-label mt-4">Blog Email</label>
                            <input value="{{$setting->blog_email}}" name="blog_email" type="text" class="form-control" id="blog_email" aria-describedby="emailHelp" placeholder="Enter blog email:">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-label mt-4">Address</label>
                            <input value="{{$setting->address}}" name="address" type="text" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Enter address:">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-danger">Update</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
