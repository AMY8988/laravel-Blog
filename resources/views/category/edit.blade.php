@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-1">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
        <li class="breadcrumb-item active">Create Category</li>
    </ol>
    <div class="card border-0">
        <div class="card-body ">
            <div class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Category</h5>
                    <a href="{{ route('category.index') }}" class="btn-link"><i class="bi bi-list"></i></a>
                </div>
            </div>
            <hr class="bg-dark">
            <form action="{{route('category.update' , $category->id)}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-5">
                        <input type="text" name="title" value=" {{ old('title' , $category->title) }}" class="form-control  @error('title') is-invalid @enderror">
                        @error('title')
                        <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary ">Add Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

