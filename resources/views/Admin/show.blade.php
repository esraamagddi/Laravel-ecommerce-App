@extends("Admin.layout")

@section('content')
@include("success")

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Product Details
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Description: {{ $product->description }}</p>
                    <p class="card-text">Price: ${{ number_format($product->price, 2) }}</p>
                    <p class="card-text">Quantity: {{ $product->quantity }}</p>
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded mx-auto d-block" style="max-width: 400px;" alt="{{ $product->name }}">
                    <!-- Adjust the max-width and styling as per your design preferences -->

                    <div class="mt-3">
                        <a href="{{ url('products') }}" class="btn btn-primary mr-2">Back to Products</a>
                        <a href="{{ url("products/edit/$product->id") }}" class="btn btn-warning">Edit</a>

                        <form action="{{ url("products/$product->id") }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
