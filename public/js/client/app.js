import addToCart from "./cart/addToCart.js";

document.addEventListener("DOMContentLoaded", function() {
    let currentLocation = window.location.host + window.location.pathname;
    console.log(currentLocation);
    if (currentLocation.includes("product")) {
        let addCartForm = document.getElementById('add-cart-form');
        addCartForm.addEventListener('click', function(event) {
            if (event.target.classList.contains('add-cart-btn')) {
                event.preventDefault();
                let productId = event.target.dataset.id;
                let routeAddToCart = '/product/' + productId;
                console.log(routeAddToCart);
                addToCart(routeAddToCart);
            }
        });
    }
});