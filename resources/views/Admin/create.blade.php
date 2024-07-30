@extends('Admin.layout')

@section('content')
@include('errors')
@include('success')

<form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
    </div>

    <div class="form-group">
        <label for="desc">Product Description</label>
        <textarea name="description" class="form-control" id="description" placeholder="Enter description"></textarea>
    </div>

    <div class="form-group">
        <label for="price">Product Price</label>
        <input type="number" name="price" class="form-control" id="price" placeholder="Enter price">
    </div>

    <div class="form-group">
        <label for="quantity">Product Quantity</label>
        <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Enter quantity">
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" name="image" class="form-control" id="image">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
