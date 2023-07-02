@extends('blog.template')
@section('content')
    <div class="my-5">
        <form action="{{ route('post.store') }}" method="POST">
            @csrf
            {{-- <div class="container mt-5">
                <label for=""> Enter Your Title </label>
                <input type="text" name="title" placeholder="Title"><br /><br />

                <label for=""> Enter Your Visibilty </label>
                <input type="text" name="visibility" placeholder="Visibility"><br /><br />

                <label for=""> Enter Your Description </label>
                <input type="text" name="desc" placeholder="Description"><br /><br />

                <label for=""> Enter Your Conetnt </label>
                <input type="text" name="content" placeholder="Content"><br /><br />

                <button type="submit" class="btn btn-info">Submit</button>
            </div> --}}
            <div class="row py-3">
                <div class="col-2">
                    <label for="title" class="col-form-label">Title</label>
                </div>
                <div class="col-5">
                    <input type="text" id="title" class="form-control" name="title" placeholder="Title" autofocus>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-2">
                    <label for="visibility" class="col-form-label">Visibility</label>
                </div>
                <div class="col-5">
                    <select class="form-select" name="visibility" id="visibility" aria-label="Default select example">
                        <option value="1">Private</option>
                        <option value="2">Unlisted</option>
                        <option value="3">Public</option>
                    </select>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-2">
                    <label for="description" class="col-form-label">Description</label>
                </div>
                <div class="col-5">
                    <textarea id="description" class="form-control" name="desc" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-2">
                    <label for="post" class="col-form-label">Content</label>
                </div>
                <div class="col-5">
                    <textarea class="form-control" id="post" name="content" placeholder="Post"></textarea>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-4"></div>
                <div class="col-5">
                    <button class="btn btn-sm btn-info">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
