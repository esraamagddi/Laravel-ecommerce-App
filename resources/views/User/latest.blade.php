
    <div class="container mt-5">
        <div class="latest-products">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading d-flex justify-content-between align-items-center">
                        <h2>Latest Products</h2>
                        <a href="products.html">View All Products <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="col-md-12 mb-4">
                    <form method="GET" action="{{ url('search') }}" class="search-bar">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control" value="{{ old('query', $query ?? '') }}" placeholder="Search for products..." aria-label="Search for products" aria-describedby="search-button">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit" id="search-button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Products -->
                @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="product-item border p-3 rounded">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded mx-auto d-block">
                        <div class="down-content mt-3">
                            <a href="{{ url('products/show/' . $product->id) }}" class="d-block mb-2"><h4>{{ $product->name }}</h4></a>
                            <h6 class="mb-2">${{ $product->price }}</h6>
                            <p class="mb-3">{{ $product->description }}</p>
                            <ul class="stars mb-2">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <span>Reviews (24)</span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>


