document.addEventListener("DOMContentLoaded", function() {
    let colorName = document.querySelector('input[name="color_name"]');
    let createBtn = document.querySelector('.create-btn');
    let inputColorName = document.querySelector('input[name="color_name"]');
    let errorMessage = document.getElementById('error-message');

    createBtn.addEventListener('click', function(event) {
        event.preventDefault();
        if (colorName.value === '') {
            errorMessage.innerHTML = 'Vui lòng nhập tên màu sắc';
        } else {
            addColor(routeAddColor, routeIndex);
        }
    });

    inputColorName.addEventListener('focus', function() {
        errorMessage.innerHTML = '';
    });

    inputColorName.addEventListener('keydown', function() {
        errorMessage.innerHTML = '';
    });
});

function addColor(routeAddColor, routeIndex)
{
    let csrfToken = document.querySelector('input[name="_token"]').value;
    let input = document.querySelector('input[name="color_name"]').value;

    fetch(routeAddColor, {
        method: 'POST',
        headers: {
            Accept: 'application/json, text/html; charset=utf-8',
            'Content-Type': 'application/json',
            'X-CSRF-Token': csrfToken
        },
        body: JSON.stringify({
            'color_name': input
        })
    })
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        if (data.status === 'success') {
            alert('Thêm thành công');
            window.location.href = routeIndex;
        }
    });
}