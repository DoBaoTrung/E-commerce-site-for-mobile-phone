{{-- @extends('layouts.client.master') --}}
{{-- @section('content')
    <div class="login-form w-25 mx-auto border border-2 rounded-2 p-4">
        <h4 class="text-center">Login Home</h4>
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <form action="{{ route('client.processLogin') }}" method="POST">
            @csrf
            <div class="form-group my-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group my-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check">
                <label for="remember" class="form-check-label">Remember me</label>
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
            </div>
            <div class="button mb-3 text-center">
                <button class="btn btn-secondary">Login</button>
            </div>
            <div class="no-account text-center">
                <p>Don't have account? <a class="text-decoration-none" href="{{ route('client.register') }}">Register</a>
                </p>
            </div>
        </form>
    </div>
@endsection --}}

<div class="modal fade" id="login-modal" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đăng nhập</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="login-form">
                    @csrf
                    <div class="form-group my-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                        {{-- @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>
                    <div class="form-group my-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                        {{-- @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror --}}
                    </div>
                    <div class="form-check">
                        <label for="remember" class="form-check-label">Remember me</label>
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    </div>
                    <div class="button mb-3 text-center">
                        <button class="btn-login btn btn-secondary">Đăng nhập</button>
                    </div>
                    <div class="no-account text-center d-flex justify-content-center">
                        <p class="px-1" style="border-right: 2px solid #ccc;" >Don't have account? <a class="text-decoration-none" href="{{ route('client.register') }}">Register</a></p>
                        <a class="mx-2 text-decoration-none" href="#">Quên mật khẩu?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if (Session::has('success'))
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true
            }
            toastr.success("{{ Session::get('success') }}", 'Success', {
                timeOut: 12000
            });
        </script>
    @endif --}}
    <script>
        $(document).ready(function() {
            const routeLogin = '{{ route('client.processLogin') }}';
            $('.btn-login').click(function() {
                event.preventDefault();
                $.ajax({
                    url: routeLogin,
                    type: 'POST',
                    data: $('#login-form').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === 'success') {
                            location.reload(true);
                        }
                    }
                })
            });
        });
    </script>
@endpush
{{-- 
$(document).ready(function() {
    $('.form-signin input').focus(function() {
        $('.validate').hide();
    });

    $('#form-signin').validate({
        rules: {
            "email": {
                required: true,
                email: true
            },
            "password": {
                required: true,
                minlength: 4
            }
        },
        errorClass: "error",
        messages: {
            "email": {
                required: "Vui lòng nhập email",
                email: "Email phải đúng định dạng"
            },
            "password": {
                required: "Vui lòng nhập mật khẩu",
                minlength: "Mật khẩu phải tối thiểu 4 ký tự"
            }
        },
        submitHandler: function() {
            $.ajax({
                type: "POST",
                url: "process_signin.php",
                data: $("#form-signin").serializeArray(),
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        $("#modal-signin").modal('hide');
                        $(".loginned").show();
                        $(".unlogin").hide();
                        $("#span-name").text(response.name);
                    } else {
                        $(".validate").text(response.message);
                        $(".validate").show();
                    }
                }
            });
        }
    }); --}}
{{-- }); --}}