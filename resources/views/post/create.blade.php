@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-1">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('post.index')}}">Posts</a></li>
        <li class="breadcrumb-item active">Create Post</li>
    </ol>
    <div class="card border-0">
        <div class="card-body ">
            <div class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create New Post</h5>
                    <a href="{{ route('post.index') }}" class="btn-link"><i class="bi bi-list"></i></a>
                </div>
            </div>
            <hr class="bg-dark">

{{--            <form action="{{ route('post.store') }}" method="post">--}}
{{--                @csrf--}}
{{--                <input type="text " name="title" >--}}
{{--                <button>add</button>--}}
{{--            </form>--}}

            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-floating mb-3">
                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               class="form-control form-control-sm @error("title") is-invalid  @enderror "
                               id="floatingInput"
                               placeholder="Title">
                        <label for="floatingInput" class="px-4">Title</label>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class=" mb-4">
                        <label for="category" class="form-label mb-1">Select Category</label>
                        <select name="category" id="category" class="form-control form-select border-0 @error('category')  is-invalid @enderror">
                            @foreach(\App\Models\Category::all() as $category)
                                <option class=""
                                        value="{{ $category->id }}"
                                        {{$category->id == old('category')?'selected':''   }}
                                >{{ $category->title }}

                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="description"
                                  class="form-control @error('description') is-invalid @enderror "
                                  placeholder="Leave a comment here"
                                  id="floatingTextarea2" style="height: 250px">{{ old('description') }}</textarea>
                        <label for="floatingTextarea2" class="px-4">Description</label>
                        @error("description")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="featured_image"  class="form-control @error('featured_image') is-invalid @enderror">
                                @error("featured_image")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <button  class="btn btn-primary ">Add Post</button>
                            </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

