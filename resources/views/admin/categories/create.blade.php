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
                    <h2>Create New Category with Questions</h2>

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <h4>Questions</h4>
                        <div id="questions-wrapper">
                            <div class="question-item">
                                <div class="form-group mb-3">
                                    <label>Question</label>
                                    <input type="text" name="questions[0][question]" class="form-control" required>
                                </div>
                                <div class="form-group  mb-3">
                                    <label>Type</label>
                                    <select name="questions[0][type]" class="form-control" required>
                                        <option value="text">Text</option>
                                        <option value="select">Select</option>
                                        <option value="data">Data</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Required</label>
                                    <input type="checkbox" name="questions[0][is_required]" value="1">
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary" id="add-question">Add Another Question</button>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Create Category with Questions</button>
                        </div>
                    </form>
                </div>

                <script>
                    let questionCount = 1;

                    document.getElementById('add-question').addEventListener('click', function () {
                        const wrapper = document.getElementById('questions-wrapper');
                        const newQuestion = document.createElement('div');
                        newQuestion.classList.add('question-item');

                        newQuestion.innerHTML =
                            `
                                <div class="form-group mb-3">
                                    <label>Question</label>
                                    <input type="text" name="questions[${questionCount}][question]" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Type</label>
                                    <select name="questions[${questionCount}][type]" class="form-control" required>
                                        <option value="text">Text</option>
                                        <option value="select">Select</option>
                                        <option value="data">Data</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Required</label>
                                    <input type="checkbox" name="questions[${questionCount}][is_required]" value="1">
                                </div>
                            `;

                        wrapper.append(newQuestion);
                        questionCount++;
                    });
                </script>
        </div>
@endsection
