<?php

namespace Laravel\Fortify\Http\Controllers;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse;
use Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse;
use Laravel\Fortify\Fortify;

class PasswordResetLinkController extends Controller
{
    /**
     * Show the reset password link request view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RequestPasswordResetLinkViewResponse
     */
    public function create(Request $request): RequestPasswordResetLinkViewResponse
    {
        return app(RequestPasswordResetLinkViewResponse::class);
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function store(Request $request): Responsable
    {
        $request->validate([
            Fortify::email() => 'required|email'
        ], [
            Fortify::email() => [
                'required' => 'Vui lòng nhập mật khẩu',
                'email' => 'Phải có định dạng email'
            ]
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = $this->broker()->sendResetLink(
            $request->only(Fortify::email())
        );

        if ($status == Password::RESET_LINK_SENT) {
            $customSuccessMessage = [
                'status' => 'Mail xác thực vừa được gửi, vui lòng kiểm tra trong hòm thư'
            ];

            $successMessage = $customSuccessMessage['status'] ?? trans($status);

            return app(SuccessfulPasswordResetLinkRequestResponse::class, ['status' => $successMessage]);
        } else {
            $customErrorMessages = [
                Password::INVALID_USER => 'Email không tồn tại trong hệ thống.',
                Password::RESET_THROTTLED => 'Vui lòng đợi trước khi yêu cầu lại.',
            ];

            $errorMessage = $customErrorMessages[$status] ?? trans($status);

            // Khi thấy app được sử dụng trong Laravel, đó thường là để truy cập các dịch vụ và đối tượng từ container. Ví dụ, app(SuccessfulPasswordResetLinkRequestResponse::class, ['status' => $status]) sử dụng container để tạo một instance của SuccessfulPasswordResetLinkRequestResponse và chuyển tham số 'status' vào đó.
            return app(FailedPasswordResetLinkRequestResponse::class, ['status' => $errorMessage]);
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker(): PasswordBroker
    {
        return Password::broker(config('fortify.passwords'));
    }
}
