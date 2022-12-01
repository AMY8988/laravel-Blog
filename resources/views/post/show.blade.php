@extends('layouts.app')

@section('content')
    <ol class="breadcrumb p-1">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Post Detail</li>
        <li class="breadcrumb-item active">{{ $post->slug }}</li>
    </ol>
    <div class="row">


            <div class="col-12 col-md-9">
                <div class="card my-4">
                    <img src="{{ @asset("storage/".$post->featured_image) }}" alt="">

                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <div class="">
                            <p class="mb-0 text-black-50"><i class="bi bi-calendar pe-2"></i>{{ $post->created_at->format('d M Y') }}</p>
                            <p class="mb-0 text-black-50"><i class="bi bi-clock-fill pe-2"></i>{{ $post->created_at->format('h:m A') }}</p>
                        </div>
                        <hr>
                        <p>{{$post->description}}</p>
                        <span class="text-black-50 fw-bolder">-{{ \App\Models\User::find($post->user_id)->name }}</span>

                    </div>
                </div>
            </div>

    </div>
@endsection
