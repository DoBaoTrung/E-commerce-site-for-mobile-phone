document.addEventListener("DOMContentLoaded", function() {
    let colorName = document.querySelector('input[name="color_name"]');
    let editBtn = document.querySelector('.edit-btn');
    let errorMessage = document.getElementById('error-message');

    editBtn.addEventListener("click", function(event) {
        event.preventDefault();
        if (colorName.value === '') {
            errorMessage.innerHTML = "Vui lòng nhập tên màu sắc";
        } else if (arrayColor.includes(colorName.value)) {
            errorMessage.innerHTML = "Màu sắc đã tồn tại";
        } else {
            updateColor(routeUpdateColor, routeIndex);
        }
    });

    colorName.addEventListener('focus', function(event) {
        errorMessage.innerHTML = '';
    });

    colorName.addEventListener('keydown', function(event) {
        errorMessage.innerHTML = '';
    });
});

function updateColor(routeUpdateColor, routeIndex) 
{
    let csrfToken = document.querySelector('input[name="_token"]').value;
    let input = document.querySelector('input[name="color_name"]').value;

    fetch(routeUpdateColor, {
        method: 'PUT',
        headers: {
            Accept: 'application/json, text/html; charset=utf-8',
            'Content-Type': 'application/json',
            'X-CSRF-Token': csrfToken
        },
        body: JSON.stringify({
            'color_name': input
        })
    })
    .then(response => response.json())
    .then(data => {
        // console.log(data);
        if (data.status === "success") {
            alert("Cập nhật thành công");
            window.location.href = routeIndex;
        }
    })
    .catch(error => alert(error));
}