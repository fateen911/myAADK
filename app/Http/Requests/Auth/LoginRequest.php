<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Rules\NoKp;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'no_kp' => ['required', 'string', new NoKp],
            'password' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'no_kp.required' => 'Sila masukkan no kad pengenalan yang sah',
            'password.required' => 'Sila masukkan kata laluan yang sah',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Retrieve the user by their 'no_kp'
        $user = \App\Models\User::where('no_kp', $this->input('no_kp'))->first();

        // Check if the user exists and their status is 'active'
        if (!$user) {
            throw ValidationException::withMessages([
                'no_kp' => ['Akaun tidak dijumpai.'],
            ]);
        }

        if ($user->acc_status == 'DIBEKUKAN') {
            throw ValidationException::withMessages([
                'no_kp' => ['Akaun anda telah dibekukan. Sila hubungi pejabat berdekatan.'],
            ]);
        }

        if (! Auth::attempt($this->only('no_kp', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'no_kp' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'no_kp' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('no_kp')).'|'.$this->ip());
    }
}
