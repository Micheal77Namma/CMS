@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Tag') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('tag.store')}}" method="POST">
                        @csrf
                        <fieldset>
                        <legend>Please Enter Your Information</legend>
                        <div class="form-group">
                            <label for="tag" class="form-label mt-4">Tag</label>
                            <input name="tag" type="text" class="form-control" id="tag" aria-describedby="emailHelp" placeholder="Enter tag:">
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
