@extends("Admin.layout")

@section('content')
@include("success")

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Product Details
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Description: {{ $product->description }}</p>
                    <p class="card-text">Price: {{ $product->price }}</p>
                    <p class="card-text">Quantity: {{ $product->quantity }}</p>
                    <img src="{{asset("storage/".$product->image)}}" class="img-fluid" alt="{{ $product->name }}">

                    <a href="{{ url('products') }}" class="btn btn-primary">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
