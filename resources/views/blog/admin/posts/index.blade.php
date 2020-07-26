@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session('success'))
            <div class="justify-content-center">
                <div class="col-md-12"></div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">Write</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>Author</td>
                                <td>Category</td>
                                <td>Slug</td>
                                <td>Published at</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $post)
                                @php
                                    /**   @var \App\Models\BlogPost $post */
                                @endphp
                                <tr @if(!$post->is_published) style="background: #ccc;" @endif>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->user_id}}</td>
                                    <td>{{$post->category_id}}</td>
                                    <td>
                                        <a href="{{ route('blog.admin.posts.edit', $post->id) }}">{{$post->title}}</a>
                                    </td>
                                    <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : '' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
                <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $paginator->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
