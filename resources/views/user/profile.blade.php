@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                <img class="profile-img" src="https://pickaface.net/assets/images/slides/slide4.png">

                <h1>{{ $user->name }}</h1>
                <h5>{{ $user->email }}</h5>
                <h5>22 years old</h5>
            </div>
        </div>
    </div>
</div>
@endsection