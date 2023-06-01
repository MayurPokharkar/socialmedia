@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center text-success">Post</h3>
                    <br/>
                    <h2>{{ $post->title }}</h2>
                    <p>
                        {{ $post->body }}
                    </p>
                    <hr />
                    @foreach ($comments as $comment)
                        @if ($comment->post_id == $post->id)
                            <a href="/profile/{{ $comment->user->id }}"><h5> <strong>{{ $comment->user->name }}: </strong></h5></a>
                            <span>{{ $comment->body }}</span>
                        @endif
                    @endforeach
   
                    <hr />
                    <h4>Add comment</h4>
                    <form method="post" action="/post/{{ $post->id }}/comment">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection