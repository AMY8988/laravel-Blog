@extends('layouts.app')

@section('content')
    <ol class="breadcrumb p-1">
        <li class="breadcrumb-item active">Home</li>
    </ol>
    <div class="card border border-0 bg-light  shadow" >
        <div class="card-body ">
           <div class="d-flex justify-content-between align-items-center">
               <h4><i class="bi bi-bookmark-check-fill me-2"></i>Daily News</h4>
               <form action="{{ route('home') }}" method="get" class="col-4">
                   <div class="input-group mb-3">
                       <input type="text" class="form-control p-2" value="{{ request('keyword') }}" name="keyword" placeholder="  Search posts information" >
                       <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                   </div>
               </form>
           </div>
        </div>
    </div>
    <div class="row vh-100 overflow-scroll">
        @foreach($posts as $post)
            <div class="col-12 col-md-6">
                <div class="card my-4">
                    <img src="{{ @asset("storage/".$post->featured_image) }}" alt="">

                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>

                        <hr>
                        <p>{{$post->excerpt}}</p>
                        <span class="text-black-50 fw-bolder">{{ \App\Models\User::find($post->user_id)->name }}</span>
                        <div class="text-end">
                            <a href="{{route("post.show", $post->id)}}" class="btn btn-sm btn-dark me-2 ">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
