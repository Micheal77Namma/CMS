@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                        <legend>Please Enter Your Information</legend>
                        <div class="form-group">
                            <label for="title" class="form-label mt-4">Title</label>
                            <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="content" class="form-label mt-4">Descritpion</label><br>
                            <textarea name="content" id="content" cols="40" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label><br>
                            <select class="form-control" id="category" name="category_id">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check">
                            <label for="tag"><br>Tags</label><br>
                            @foreach ($tags as $tag)
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" value="{{$tag->id}}" name="tags[]">
                            <label class="form-check-label" for="exampleCheck1">{{$tag->tag}}</label><br>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="featured" class="form-label mt-4">Photo</label>
                            <input name="featured" type="file" class="form-control">
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
