@extends('layout')
@section('title','Create')
@section('content')
    <div class="form-temp">
        <div class="container">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            @endif
            @if(session('success'))
                <p class="alert alert-success">{{session('success')}}</p>
            @endif
                    <h2>Create New Product</h2>

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Product Price</label>
                        <input type="text" name="price" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Product Description</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="questions-container">

                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#category_id').change(function() {
                    let categoryId = $(this).val();
                    if (categoryId) {
                        $.ajax({
                            url: '/categories/' + categoryId + '/questions',
                            type: 'GET',
                            success: function(questions) {
                                let questionsContainer = $('#questions-container');
                                questionsContainer.empty();
                                questions.forEach(function(question) {
                                    let questionHtml = `<div class="form-group mb-3">
                                <label>${question.question}</label>`;
                                    if (question.type === 'text') {
                                        questionHtml += `<input type="text" name="answers[${question.id}][answer]" class="form-control" required>
                                                 <input type="hidden" name="answers[${question.id}][question_id]" value="${question.id}">`;
                                    } else if (question.type === 'select') {
                                        questionHtml += `<select name="answers[${question.id}][answer]" class="form-control" required>
                                    <option value="default">Select an option</option>
                                    <!-- Add options dynamically if needed -->
                                </select>
                                <input type="hidden" name="answers[${question.id}][question_id]" value="${question.id}">`;
                                    } else if (question.type === 'data') {
                                        questionHtml += `<textarea name="answers[${question.id}][answer]" class="form-control" required></textarea>
                                                 <input type="hidden" name="answers[${question.id}][question_id]" value="${question.id}">`;
                                    }
                                    questionHtml += `</div>`;
                                    questionsContainer.append(questionHtml);
                                });
                            },
                            error: function() {
                                $('#questions-container').empty();
                            }
                        });
                    } else {
                        $('#questions-container').empty();
                    }
                });
            });
        </script>
        </div>
@endsection
