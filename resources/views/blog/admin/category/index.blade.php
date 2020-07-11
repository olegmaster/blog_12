@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('blog.admin.categories.create') }}">Добавить</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>slug</th>
                                <th>description</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                            </tr>
                            </thead>
                            @foreach($paginator as $page)
                                @php /** @var \App\Models\BlogCategory $page  */ @endphp
                                <tr>
                                    <td>{{$page->id}}</td>
                                    <td>
                                        <a href="{{route('blog.admin.categories.edit', $page->id)}}">
                                            {{$page->title}}
                                        </a>
                                    </td>
                                    <td>{{$page->slug}}</td>
                                    <td>{{$page->description}}</td>
                                    <td>{{$page->created_at}}</td>
                                    <td>{{$page->updated_at}}</td>
                                </tr>
                            @endforeach
                        </table>
                        @if($paginator->total() > $paginator->count())
                            {{$paginator->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
