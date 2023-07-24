@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            min-height: 100vh;
        }

        .text-gray {
            color: #999;
        }
    </style>
</head>
<body>

</body>
</html>

<section class="section about-section gray-bg" id="about">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text go-to">
                    <h3 class="dark-color">{{ $user->name }}</h3>
                    <h6 class="theme-color lead">{{ $user->job_title }} in {{ $user->country }}</h6>
                    <p>{{ $user->brief }}</p>
                    <div class="row about-list">
                        <div class="col-md-6">
                            <div class="media">
                                <label> <strong>Birthday:</strong></label>
                                <p>&nbsp{{$user->dob}}</p>
                            </div>
                            <div class="media">
                                <label> <strong> Country:</strong></label>
                                <p>&nbsp{{$user->country }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="media">
                                <label><strong>Mail:</strong></label>
                                <p>&nbsp{{$user->email }}</p>
                            </div>
                            <div class="media">
                                <label><strong>Phone:</strong></label>
                                <p>&nbsp{{ $user->phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" title="" alt="">
                </div>
            </div>
        </div>
        <div class="counter mt-3">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        {{-- {{ dd($user->posts->count()) }} --}}
                        <h6 class="count h2" data-to="500" data-speed="500">{{ $myPosts->count() }}</h6>
                        <p class="m-0px font-w-600">Posts</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="150" data-speed="150">{{ $myComment->count() }}</h6>
                        <p class="m-0px font-w-600">Reactions on post</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="850" data-speed="850">{{ $user->likes->count() }}</h6>
                        <p class="m-0px font-w-600">Likes</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="190" data-speed="190">+44</h6>
                        <p class="m-0px font-w-600">Country Code</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown-divider m-4"></div>

        @if ($user->id == Auth::user()->id)
            <a href="/profile/{{$user->id}}/edit">
                <button type="button" class="btn btn-outline-primary float-right ">Edit Your Profile</button>
            </a>
            <a href="/profile/{{$user->id}}/create-post">
                <button type="button" class="btn btn-primary">Create New Post</button>
            </a>
        @endif

    </div>

    <div class="container p-5">
        @foreach ($posts as $post)
            @if($post->user_id == request()->route()->parameters['id'])
            <div class="container py-3">
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <ul class="timeline list-unstyled">
                                <li class="timeline-item bg-white rounded ml-3 p-4 shadow ">
                                    <div class="timeline-arrow"></div>
                                    <span>
                                        <form method="post" action="{{ route('post.like', $post->id) }}">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <button class="btn btn-success float-right" type="submit"> {{ $post->likes->count() }} <i class="bi bi-star-fill"></i></button>
                                        </form>
                                    </span>
                                    <h2 class="h5 mb-0"> <strong>Post Created By: </strong>{{ $post->user->name }}</h2>
                                    <h3 class="h5 mb-0 small text-secondaty"><strong>Post Created At: </strong>{{ $post->created_at->format('Y-m-d') }} <strong>at: </strong> {{ $post->created_at->format('H:i:s') }}</h3>
                                    <h3 class="h5 mb-0 small text-secondary"> <strong>Post Title: </strong>{{ $post->title }}</h3><span class="small text-gray"><i class="fa fa-clock-o mr-1"></i> </span>
                                    <p class="text-small mt-2 font-weight-light">{{ $post->body }}</p>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Comment">
                                        <div class="input-group-append">
                                            <form method="post" action="/post/{{ $post->id }}/comment">
                                                @csrf
                                                <input type="submit" name="body" class="btn btn-primary float-left ml-1 mr-1" value="Comment">
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <a href="/post/{{ $post->id }}/comments" class="btn btn-dark mr-1">{{ $post->comments->count() }} <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                </svg></a>
                                            </form>

                                            @if(Auth::user()->id == $post->user_id)
                                            <span>
                                                {{-- <form method="post" action="{{ route('post.delete', $post->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{ $post->id }}">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                      </svg></button>
                                                </form> --}}
                                                <form method="post" action="{{ route('post.delete', $post->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{ $post->id }}">
                                                    <button type="submit" class="btn btn-danger float-right"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg></button>
                                                </form>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>
@endsection
