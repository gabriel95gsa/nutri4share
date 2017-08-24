@extends('layouts.app')

@section('content')
    <div class="post-create-container">
        <div class="post-create-header">
            <div class="post-create-pic-field">
                <div class="post-create-profile-pic">
                    <a href="/profile/{{ Auth::user()->username }}">
                        <img src="{{ asset('images\eu.jpg') }}">
                    </a>
                </div>
            </div>
            <div class="post-create-btn-field">
                <div class="post-create-btn-option">
                    <a id="btn-create-post" data-btn-select="true" href="#">Create Post</a>
                </div>
            </div>
            <div class="post-live-video-field">
                <div class="post-create-btn-option">
                    <a id="btn-live-video" data-btn-select="false" href="#">Live Video</a>
                </div>
            </div>
        </div>
        <div class="post-create-body">
            <div class="post-create-field">
                <div id="post-text-content" class="text-writter-field" contenteditable="true" data-placeholder-default="Tell us your news!"></div>
            </div>
            <div class="live-video-field" hidden></div>
            <div id="files-upload-box" class="img-vid-upload-field"></div>
        </div>
        <div class="post-create-footer">
            <div class="post-add-content-options">
                <div>
                    <div class="post-add-option" data-option-title="Add a photo or video">
                        <input type="file" accept="image/*, video/*" id="img_upload" name="img_upload" class="file">
                        <button class="btn-hidden browse" type="button">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <div class="post-add-option" data-option-title="Add location">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="post-add-btn-field">
                <button id="create_post_btn" class="btn-standard btn-confirm-post btn-disabled">
                    <span>Post</span>
                </button>
            </div>
        </div>
    </div>
    <div class="timeline-container">
        @forelse($posts as $post)
        <div class="post-container">
            <div class="post-content">
                <div class="post-content-midia" data-file-asset="{{ asset('images/login_register_background.jpg') }}">
                    <img src="{{ asset('images/login_register_background.jpg') }}">
                </div>
                <div class="post-content-info-container">
                    <div class="post-profile-pic-area">
                        <div class="post-profile-pic">
                            <a href="/profile/{{ Auth::user()->username }}">
                                <img src="{{ asset('images/eu.jpg') }}">
                            </a>
                        </div>
                    </div>
                    <div class="post-content-info-options-area">
                        <div class="post-content-info">
                            <span class="post-info-user-name">
                                <a href="/profile/{{ Auth::user()->username }}">
                                    {{ $post->getUserName() }}
                                </a>
                            </span>
                            <span class="post-info-time-location">
                                {{ $post->getCarbonCreatedAttribute()->diffForHumans() }}
                            </span>
                        </div>
                        <div class="post-content-options">
                            @if($post->user_id === Auth::id())
                            <div class="post-dropdown">
                                <i class="fa fa-angle-down fa-2x" aria-hidden="true"></i>
                                <div class="post-dropdown-content">
                                    <div class="post-dropdown-caret">
                                        <div class="post-dropdown-caret-inner"></div>
                                        <div class="post-dropdown-caret-outer"></div>
                                    </div>
                                    <div class="">
                                        <a class="post-dropdown-options" href="#">Edit</a>
                                    </div>
                                    <div class="">
                                        <a class="post-dropdown-options" href="#">Delete</a>
                                    </div>
                                    <div class="">
                                        <a class="post-dropdown-options" href="#">Other Option</a>
                                    </div>
                                    <div class="">
                                        <a class="post-dropdown-options" href="#">Teste</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="post-content-body">
                    <div class="post-content-article">
                        <p>
                            <i class="fa fa-quote-right" aria-hidden="true"></i>
                            {{ $post->shortContent }}
                            @if(strlen($post->content) > 200)
                                <a href="/posts/{{ $post->id }}">... Read more</a>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="post-content-footer">
                    @if($post->getNumberOfLikes() == 1)
                        <span>{{ $post->getNumberOfLikes() }} Like</span>
                    @elseif($post->getNumberOfLikes() > 1)
                        <span>{{ $post->getNumberOfLikes() }} Likes</span>
                    @endif
                    <div class="post-like-button">
                        <i id="button_{{ $post->id }}" name="like_button" class="fa fa-heart-o" aria-hidden="true"></i>
                    </div>
                    <div class="post-option-field">
                        <i class="fa fa-comments" aria-hidden="true"></i>
                    </div>
                    <div class="post-option-field">
                        <i class="fa fa-share" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        @empty
            No posts.
        @endforelse
    </div>
    <input type="hidden" name="post_selected" value="">
@endsection