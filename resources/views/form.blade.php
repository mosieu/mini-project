@extends('index')

@section('title')
    Form
@endsection

@section('content')
    <div style="width: 100%;height: 100vh;display: flex;justify-content: center;align-items: center;flex-direction: column">
        @if($errors->any())
            <div class="alert alert-danger" role="alert" style="width: 500px">
                {{$errors->first()}}
            </div>
        @endif

        <form method="post" action="{{route('submitForm')}}" style="width: 500px">
            @csrf
            <div class="form-group">
                <label for="category">Product Category</label>
                <input type="text" name="category_url" class="form-control" id="category" placeholder="Enter Category Url">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection
