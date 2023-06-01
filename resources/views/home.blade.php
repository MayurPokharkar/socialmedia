@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <style>
            <style>
        body {
            /* background: #E8CBC0;
            background: -webkit-linear-gradient(to right, #E8CBC0, #636FA4);
            background: linear-gradient(to right, #E8CBC0, #636FA4); */
            min-height: 100vh;
        }

        .text-gray {
            color: #999;
        }
    </style>
</head>
<body>

<script>
  function getCommentValue() {
    var comment = document.getElementById("commentInput").value;
    submitButton.value = comment
    console.log(comment); // Display the comment value in the browser console
    // You can do further processing with the comment value here
  }
</script>
</body>
</html>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.news_feed') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}

                        </div>
                    @endif
                    @foreach ($posts as $post)
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
                                        <h2 class="h5 mb-0"> <strong>{{ __('messages.post_created_by') }}: </strong>{{ $post->user->name }}</h2>
                                        <h3 class="h5 mb-0 small text-secondaty"><strong>Post Created At: </strong>{{ $post->created_at->format('Y-m-d') }} <strong>at: </strong> {{ $post->created_at->format('H:i:s') }}</h3>
                                        <h3 class="h5 mb-0 small text-secondary"> <strong>Post Title: </strong>{{ $post->title }}</h3><span class="small text-gray"><i class="fa fa-clock-o mr-1"></i> </span>
                                        <p class="text-small mt-2 font-weight-light">{{ $post->body }}</p>

                                        <form method="post" action="/post/{{ $post->id }}/comment">
                                            @csrf
                                            <div class="input-group">
                                                <input type="text" name="body" class="form-control" placeholder="Enter your comment here..." aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                    <input type="submit" class="btn btn-primary float-left ml-1 mr-1" value="{{ __('messages.comment') }}">
                                                    <a href="/post/{{ $post->id }}/comments" class="btn btn-dark mr-1">
                                                        {{ $post->comments->count() }}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                                                            <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                        </svg>
                                                    </a>

                                        </form>


                                                @if(Auth::user()->id == $post->user_id)
                                                <span>
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
                @endforeach
                </div>
            </div>
            <div class="card">
                            <div class="card-header">{{ __('messages.notifications') }}</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}

                                    </div>
                                @endif
                                @foreach ($notifications as $notification)
                                <div class="container py-3">
                                    <div class="row">
                                        <div class="col-lg-12 mx-auto">
                                            <ul class="timeline list-unstyled">
                                                <li class="timeline-item bg-white rounded ml-3 p-4 shadow ">
                                                    <div class="timeline-arrow"></div>
                                                    <h2 class="h5 mb-0"> <strong>{{ __('Notification From') }}: </strong>{{ $notification->user->name }}</h2>
                                                    <h3 class="h5 mb-0 small text-secondaty"><strong>Notification Created At: </strong>{{ $notification->created_at->format('Y-m-d') }} <strong>at: </strong> {{ $post->created_at->format('H:i:s') }}</h3>
                                                    <h3 class="h5 mb-0 small text-secondary"> <strong>Notification Type: </strong>{{ $notification->type }}</h3><span class="small text-gray"><i class="fa fa-clock-o mr-1"></i> </span>
                                                    <p class="text-small mt-2 font-weight-light">{{ $notification->body }}</p>


                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('messages.users') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($users as $user)
                    <div class=" mb-4 container w-100" >
                        <img class="card-img-top" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Card image cap">
                        <div class="card-body w-100">
                          <h5 class="card-title display-6 font-italic"><a href="profile/{{ $user->id }}">{{ $user->name }}</a></h5>
                          <p class="card-text">{{ $user->brief }}.</p>
                          <a href="profile/{{ $user->id }}" class="btn btn-primary">{{ __('messages.profile') }}</a>
                        </div>

                        <hr class="mt-3 mb-3"/>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
