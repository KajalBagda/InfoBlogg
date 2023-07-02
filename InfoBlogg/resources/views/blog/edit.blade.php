@extends('blog.template')
@section('content')
    <div class="my-5">
        <form action="{{ route('post.update',$post->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row py-3">
                <div class="col-2">
                    <label for="title" class="col-form-label">Title</label>
                </div>
                <div class="col-5">
                    <input type="text" id="title" class="form-control" name="title" placeholder="Title" autofocus value="{{ $post->title }}">
                </div>
            </div>
            <div class="row py-2">
                <div class="col-2">
                    <label for="visibility" class="col-form-label">Visibility</label>
                </div>
                <div class="col-5">
                    <select class="form-select" name="visibility" id="visibility" aria-label="Default select example">
                        <option @selected($post->visibility == 1) value="1">Private</option>
                        <option @selected($post->visibility == 2) value="2">Unlisted</option>
                        <option @selected($post->visibility == 3) value="3">Public</option>
                    </select>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-2">
                    <label for="description" class="col-form-label">Description</label>
                </div>
                <div class="col-5">
                    <textarea id="description" class="form-control" name="desc" placeholder="Description">{{$post->desc}}</textarea>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-2">
                    <label for="post" class="col-form-label">Content</label>
                </div>
                <div class="col-5">
                    <textarea class="form-control" id="post" name="content" placeholder="Post">{{$post->content}}</textarea>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-4"></div>
                <div class="col-5">
                    <button class="btn btn-sm btn-info">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
