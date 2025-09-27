<?php

namespace App\Services;

use App\DTOs\LoginAttemptDto;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

readonly class AuthenticationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private string $defaultGuard,
    )
    {
        //
    }

    public function authenticate(LoginAttemptDto $dto): void
    {
        $throttleKey = $this->getThrottleKey($dto);

        $this->ensureIsNotRateLimited($throttleKey, $dto);

        $guard = Auth::guard($dto->guard ?? $this->defaultGuard);

        if (!$guard->attempt($dto->credentials(), $dto->remember)) {
            RateLimiter::hit($throttleKey);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($throttleKey);

    }

    /**
     * Check if the user is rate limited
     */
    private function ensureIsNotRateLimited(string $throttleKey, LoginAttemptDTO $loginAttempt): void
    {
        if (!RateLimiter::tooManyAttempts($throttleKey, 5)) {
            return;
        }

//        event(new Lockout($loginAttempt));

        $seconds = RateLimiter::availableIn($throttleKey);

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    private function getThrottleKey(LoginAttemptDTO $loginAttempt): string
    {
        return Str::transliterate(
            Str::lower($loginAttempt->email) . '|' . $loginAttempt->ipAddress
        );
    }

}
