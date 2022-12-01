@extends('layouts.app')
@section('content')
    <ol class="breadcrumb p-1">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active">Manage Post</li>
    </ol>
    <div class="card border-0">
        <div class="card-body">
            <div class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Post Lists</h5>
                    <a href="{{ route('post.create') }}" class="btn-link"><i class="bi bi-plus-circle"></i></a>
                </div>
            </div>
            <hr>
            <div>
                {{ $posts->links() }}
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Owner</th>
                    <th>Control</th>
                    <th>Created_at</th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            {{ $post->title }}
                        </td>
                        <td>
                            {{ $post->excerpt }}
                        </td>
                        <td>
                            {{ \App\Models\Category::find($post->category_id)->title }}
                        </td>
                        <td>
                            {{ \App\Models\User::find($post->user_id)->name }}
                        </td>
                        <td class="text-nowrap">
                            <div class="d-flex">
                                <a href="{{route("post.edit", $post->id)}}" class="btn btn-sm btn-dark me-2"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route("post.destroy" , $post->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" id="del" class="btn btn-sm btn-dark "><i class="bi bi-trash3"></i></button>
                                </form>
                                @push('script')


                                @endpush
                            </div>
                        </td>
                        <td class="text-nowrap">
                            <p class="mb-0 text-black-50"><i class="bi bi-calendar pe-2"></i>{{ $post->created_at->format('d M Y') }}</p>
                            <p class="mb-0 text-black-50"><i class="bi bi-clock-fill pe-2"></i>{{ $post->created_at->format('h:m A') }}</p>
                        </td>
                    </tr>
                @empty

                @endforelse
                </tbody>
            </table>
            <div>
                {{ $posts->onEachSide(1)->links() }}
            </div>

        </div>
    </div>
@endsection

