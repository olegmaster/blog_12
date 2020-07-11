@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <form method="post" action="{{ route('blog.admin.categories.store') }}">
                            @csrf

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
