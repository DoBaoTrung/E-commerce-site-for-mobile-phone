function addToCart(routeAddToCart)
{
    let csrfToken = document.querySelector('input[name="_token"]').value;

    fetch(routeAddToCart, {
        method: 'POST',
        headers: {
            'X-CSRF-Token': csrfToken,
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
}

export default addToCart;