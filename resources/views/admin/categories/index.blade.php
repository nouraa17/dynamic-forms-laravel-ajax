@extends('layout')
@section('title','Admin | Categories')

@section('content')
    <div class="users_list">
        <div class="container">
            <a href="/categories/create" class="btn btn-primary mb-5">Add Category</a>
            <h1 class="my-4">All Categories</h1>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            @endif
            @if(session('success'))
                <p class="alert alert-success">{{session('success')}}</p>
            @endif
            <table class="table table-bordered table-striped text-center">
                <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @if($categories->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No categories found.</td>
                    </tr>
                @else
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
