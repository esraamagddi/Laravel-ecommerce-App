
    
    <div class="container">
        <div class="product-details">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded mx-auto d-block" style="max-width: 300px;" alt="{{ $product->name }}">
                </div>
                <div class="col-md-6">
                    <h1>{{ $product->name }}</h1>
                    <h3>${{ $product->price }}</h3>
                    <p>{{ $product->description }}</p>
                    <br>
                    <a href="{{ url('cart/add/' . $product->id) }}" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
