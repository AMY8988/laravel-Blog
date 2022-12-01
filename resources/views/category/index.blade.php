@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-1">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Manage Category</li>
    </ol>
    <div class="card border-0">
        <div class="card-body">
            <div class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create New Category</h5>
                    <a href="{{ route('category.create') }}" class="btn-link"><i class="bi bi-plus-circle"></i></a>
                </div>
            </div>
            <hr>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Control</th>
                        <th>Created_at</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                {{ $category->title }}
                                <span class="badge bg-secondary ">{{ $category->slug }}</span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{route("category.edit", $category->id)}}" class="btn btn-sm btn-dark me-2"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route("category.destroy" , $category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" id="del" class="btn btn-sm btn-dark "><i class="bi bi-trash3"></i></button>
                                    </form>

                                </div>
                            </td>
                            <td>
                                <p class="mb-0 text-black-50"><i class="bi bi-calendar pe-2"></i>{{ $category->created_at->format('d M Y') }}</p>
                                <p class="mb-0 text-black-50"><i class="bi bi-clock-fill pe-2"></i>{{ $category->created_at->format('h:m A') }}</p>
                            </td>
                        </tr>
                    @empty

                     @endforelse
                </tbody>
            </table>


        </div>
    </div>
@endsection
