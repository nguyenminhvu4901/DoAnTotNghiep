<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\CouponUser\Models\CouponUser;
use App\Rules\Captcha;
use Illuminate\Http\Request;
use App\Domains\Coupon\Models\Coupon;
use App\Domains\Auth\Events\User\UserLoggedIn;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class LoginController.
 */
class LoginController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('frontend.user.dashboard');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function customLogout(Request $request)
    {
        $couponUsers = CouponUser::where('user_id', auth()->user()->id)
            ->where('is_used', config('constants.is_used.false'))
            ->get();

        if (session()->has('coupon_name')) {
            $coupon = Coupon::where('name', session('coupon_name'))->first();

            $coupon->update([
                'quantity' => (int) $coupon->quantity + 1
            ]);
            $coupon->detachUser(auth()->user()->id);
        } else if (!$couponUsers->isEmpty()) {
            foreach ($couponUsers as $couponUser) {
                $coupon = Coupon::findOrFail($couponUser->coupon_id);

                $coupon->update([
                    'quantity' => (int) $coupon->quantity + 1
                ]);

                $coupon->detachUser(auth()->user()->id);
            }
        }

        return $this->logout($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'exists:users,email', 'email'],
            $this->username() => ['required', 'max:255', 'string'],
            'password' => array_merge(['max:100'], PasswordRules::login()),
            'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
        ], [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);
    }

    public function index(Request $request)
    {
        if ($request->user()) {
            return view('frontend.user.dashboard');
        }

        return $this->showLoginForm();
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [__('account or password is incorrect')],
        ]);
    }

    /**
     * Overidden for 2FA
     * https://github.com/DarkGhostHunter/Laraguard#protecting-the-login.
     *
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        try {
            $login =  $this->guard()->attempt(
                $this->credentials($request),
                $request->filled('remember')
            );

            $couponUsers = CouponUser::where('user_id', auth()->user()->id)
                ->where('is_used', config('constants.is_used.false'))
                ->get();

            foreach ($couponUsers as $couponUser) {
                $coupon = Coupon::findOrFail($couponUser->coupon_id);

                $coupon->update([
                    'quantity' => (int) $coupon->quantity + 1
                ]);

                $coupon->detachUser(auth()->user()->id);
            }

            return $login;
        } catch (HttpResponseException $exception) {
            $this->incrementLoginAttempts($request);

            throw $exception;
        }
    }


    protected function authenticated(Request $request, $user)
    {
        if (!$user->isActive()) {
            auth()->logout();
            return redirect()->route('frontend.auth.login')->withFlashDanger(__('Your account has been deactivated.'));
        }
        event(new UserLoggedIn($user));

        if (config('boilerplate.access.user.single_login')) {
            auth()->logoutOtherDevices($request->password);
        }
    }
}
