@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="create-edit-post-body">
                <form method="POST" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
                    {{ method_field('PUT') }}

                    {{ csrf_field() }}
                    
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    
                    <div class="create-edit-post-header">
                        <a class="user-profile-link" href="/profile/{{ Auth::user()->username }}">
                            <span>{{ $post->getUserName() }}</span>
                        </a>
                        
                        <span class="pull-right">
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="create-edit-post-container">
                        <textarea name="content" class="form-control">{{ $post->content }}</textarea>
                        
                        <div class="post-image-container">
                            <img src="{{ asset($post->getImgPath()) }}">
                        </div>
                    </div>
                    
                    <div class="create-edit-post-footer">
                        <div class="row posts-form-box-bottom">
                            <div class="col-md-9">
                                <input type="file" name="img_upload" class="file">
                                <div class="input-group col-xs-12">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                    <input type="text" class="form-control" disabled placeholder="Upload Image">
                                    <span class="input-group-btn">
                                        <button class="browse btn btn-primary" type="button">
                                            <i class="glyphicon glyphicon-search"></i> Add Photo
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="submit" class="btn btn-info pull-right" value="Save">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection