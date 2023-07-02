@extends('blog.template')
@push('title', 'Home - InfoBlogg')
@section('content')
    <div class="container-fluid pb-2 mb-8" style="background-image: url('Carousal-Item-1.png');height: 70vh">
        <center>
            <h1 class="mx-auto mt-5 mb-7 pt-5" style="width: 600px; color:#2b3035"><b>All about INFOBLOGG</b></style>
            </h1>
            <a href="{{ route('post.index') }}">
                <button type="submit" class="btn btn-info mt-5 mb-6">Go To Blog</button>
            </a>
        </center>
    </div>
    <div class="container">
        <div>
            Hello
            @foreach ($posts as $post)
                <div class="card cardCustom my-3">
                    <div class="card-body">
                        <a class="fw-bold text-decoration-none" href="/">Article by {{ $post->getAuthor->fname }} ({{ $post->unique_views }} Views)</a>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"></path>
                            </svg>
                            <span class="ms-2">{{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y') }}</span>
                            {{-- <span class="ms-2">{{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y, g:i a') }}</span> --}}
                        </h6>
                        <p class="card-text font-monospace text-muted">{{ $post->desc }}</p>
                        <a href="{{ route('post.show', $post->id) }}">
                            <button class="btn btn-primary mt-2 rounded-custom">Start Reading</button>
                        </a>
                        <p name="keywords" hidden="">Code 4 Me, Code4me, PHP, Laravel</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
