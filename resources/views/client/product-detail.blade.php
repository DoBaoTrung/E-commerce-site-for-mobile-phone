@extends('layouts.client.master')
@section('content')
    <div class="product-detail-view">
        <div class="card border-dark shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="col-12 d-flex justify-content-center">
                            <img src="{{ asset(Storage::url($product->avatar)) }}" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h3 class="my-3">{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <hr>
                        <div class="product-price mt-4">
                            <h4 class="text-secondary">{{ formatNumberPrice($product->price) . '₫' }}</h4>
                        </div>
                        @if (Auth::check())
                            <div class="order-product mt-4">
                                <form id="add-cart-form" method="POST">
                                    @csrf
                                    <button class="add-cart-btn btn btn-primary" data-id="{{ $product->id }}"><i class="fas fa-shopping-cart"></i>
                                        Add to cart</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row mt-4">
                    <nav class="d-flex justify-content-center">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab">Home</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-comment"
                                type="button" role="tab">Comment</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                                type="button" role="tab">Contact</button>
                        </div>
                    </nav>
                    <div class="tab-content mt-3 w-75 mx-auto" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel">{{ $product->description }}</div>
                        <div class="tab-pane fade" id="nav-comment" role="tabpanel">
                            <h4 class="mt-3">Comments</h4>
                            <div class="textarea-comment">
                                <div class="row">
                                    <div class="col-1">
                                        <img src="" alt="user-img">
                                    </div>
                                    <div class="col-9">
                                        <textarea rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel">Liên hệ</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="module" src="{{ asset('js/client/app.js') }}"></script>
    <script>
        // let addCartForm = document.getElementById('add-cart-form');

        // addCartForm.addEventListener('click', function(event) {
        //     if (event.target.classList.contains('add-cart-btn')) {
        //         event.preventDefault();
        //         let productId = event.target.dataset.id;
        //         let routeAddToCart = "{{ route('client.addToCart', ['id' => ':id']) }}".replace(':id', productId);
        //         addToCart(routeAddToCart)
        //     }
        // });

        // function addToCart(routeAddToCart)
        // {
        //     let csrfToken = document.querySelector('input[name="_token"]').value;

        //     fetch(routeAddToCart, {
        //         method: 'POST',
        //         headers: {
        //             'X-CSRF-Token': csrfToken,
        //             'Accept': 'application/json'
        //         }
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         console.log(data);
        //     })
        // }
    </script>
@endpush
