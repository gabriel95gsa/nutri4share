@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="create-edit-post-body">
                <form method="POST" action="/posts" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <div class="create-edit-post-header">
                        <span>{{ Auth::user()->name }}, create a post!</span>
                    </div>
                    
                    <div class="posts-form-box">
                        <div class="container">
                            <div class="row">
                                <textarea name="content" class="form-control" placeholder="Tell us your news!"></textarea>
                            </div>
                            <div class="row">
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
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
                                    <input type="submit" class="btn btn-info pull-right" value="Create">
                                </div>
                            </div>
                            <div class="row">
                                @if ($errors->has('img_upload'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('img_upload') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection