@extends('layout')
@section('title','Admin | Products')

@section('content')
    <div class="users_list">
        <div class="container">
            <h1 class="my-4">All Products</h1>
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
                    <th>Description</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                @if($products->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No products found.</td>
                    </tr>
                @else
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
