@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-12 col-md-offset-2">
                <h1>Create post</h1>
                
                <form method="POST" action="{{ route('post.create', ['id' => $user->id]) }}">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="{{ $user->id }}" name="user_id">
                    <div class="form-group">
                        <label for="title">Title <span class="require">*</span></label>
                        <input type="text" class="form-control" name="title" />
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="5" class="form-control" name="body" ></textarea>
                    </div>
                    
                    <div class="form-group">
                        <p><span class="require">*</span> - required fields</p>
                    </div>
                    
                    <div class="form-group">
                        
                        <input class="btn btn-primary" type="submit" name="submit" value="Post">
                        <input class="btn btn-secondary" type="submit" value="Cancel">
                    </div>
                </form>
            </div>
            
        </div>
    </div>
@endsection