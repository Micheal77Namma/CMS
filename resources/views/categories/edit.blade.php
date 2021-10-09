@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit {{$category->name}} Category</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('category.update',$category->id)}}" method="POST">
                        @csrf
                        {{method_field('PATCH')}}
                        <fieldset>
                        <legend>Please Edit the category</legend>
                        <div class="form-group">
                            <label for="name" class="form-label mt-4">Name</label>
                            <input value="{{$category->name}}" name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name:">
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
