document.addEventListener("DOMContentLoaded", function () {
    let buttonEdit = document.querySelector(".edit-btn");
    let input = document.querySelector("input[name=capacity]");
    let errorMessage = document.getElementById("error-message");

    input.addEventListener("focus", function () {
        errorMessage.innerHTML = "";
    });

    input.addEventListener("keydown", function () {
        errorMessage.innerHTML = "";
    });

    buttonEdit.addEventListener("click", function (event) {
        event.preventDefault();
        if (input.value === "") {
            errorMessage.innerHTML = "Vui lòng nhập thông tin";
        } else {
            updateCapacity(capacityId);
        }
    });

    function updateCapacity(capacityId) {
        let csrfToken = document.querySelector("input[name=_token]").value;
        fetch(routeUpdate, {
            method: "PUT",
            headers: {
                Accept: "application/json, text/html",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                capacity: input.value,
                _token: csrfToken,
            }),
        })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            if (data.status == "success") {
                alert("Sửa thành công");
                window.location.href = routeHome;
            }
        })
        .catch((error) => {
            alert("Thất bại");
        });
    }
});
