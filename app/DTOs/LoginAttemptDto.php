<?php

namespace App\DTOs;

class LoginAttemptDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $email,
        public string $password,
        public bool $remember = false,
        public ?string $guard = null,
        public ?string $ipAddress = null,
        public ?string $userAgent = null,
    )
    {}

    /**
     * Get the credentials array for authentication
     */
    public function credentials(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    /**
     * Create DTO from request data (used by Livewire components)
     */
    public static function fromRequest(array $data, ?string $guard = null): self
    {
        return new self(
            email: trim($data['email']),
            password: $data['password'],
            remember: $data['remember'] ?? false,
            guard: $guard,
            ipAddress: request()->ip(),
            userAgent: request()->userAgent(),
        );
    }
}
