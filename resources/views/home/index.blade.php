@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default welcome-panel">
                <div class="panel-body">
                    <div class="welcome-panel-title">
                        <h3>Hello {{ Auth::user()->name }}!</h3>
                    </div>
                    
                    <p>What about to share your experiences or to see what people are sharing?</p>
                    <p>Now you can access your dashboard or create/view posts and edit your bio info.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection