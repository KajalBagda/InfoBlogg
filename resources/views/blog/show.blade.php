@extends('blog.template')
@section('content')
    {{-- <div class="my-5"> --}}
    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        {{-- <div class="container-fulid" style="background-image: url('{{ asset('website development-min.jpg') }}');height: 70vh"> --}}
        <div class="container-fulid">
            <h1> {{ $post->title }} </h1>
            <p> {{ $post->desc }}</p>
        </div>
        <p>{{!!$post->content !!}}</p>
    </form>
    {{-- </div> --}}
@endsection
