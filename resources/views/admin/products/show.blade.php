@extends('layout')
@section('title','Admin | Products')

@section('content')
    <div class="users_list">
        <div class="container">
            <h2>{{ $product->name }}</h2>
            <p>Description: {{ $product->description }}</p>
            <p>Price: {{ $product->price }}</p>
            <h3>Questions and Answers</h3>
            <ul>
                @foreach($product->questions as $question)
                    <li>
                        <strong>{{ $question->question }}</strong><br>
                        Answer: {{ $question->answer->firstWhere('product_id', $product->id)->answer ?? 'No answer provided' }}
                    </li>
                @endforeach
            </ul>
    </div>
@endsection
