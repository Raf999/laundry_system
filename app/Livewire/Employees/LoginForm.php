<?php

namespace App\Livewire\Employees;

use App\DTOs\LoginAttemptDto;
use App\Services\AuthenticationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LoginForm extends Component
{
    public $email;
    public $password;
    public $remember = false;
    public $isLoading = false;

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'remember' => 'boolean',
        ];
    }

    public function login(AuthenticationService $authService): void
    {
        $this->isLoading = true;
        $this->resetErrorBag();
        Log::debug($this->password);
        Log::debug($this->email);

        try {
            $this->validate();
            $dto = LoginAttemptDto::fromRequest([
                'email' => $this->email,
                'password' => $this->password,
                'remember' => $this->remember
            ], 'employees');

            Log::info("Login attempt for {$this->email} and {$this->password}");
            $authService->authenticate($dto);

            // Show success message (optional)
            session()->flash('success', 'Login successful! Redirecting...');

            // Regenerate session
            request()->session()->regenerate();

            // Reset form
            $this->reset(['email', 'password', 'remember']);

            $this->redirect(route('employee.dashboard'));
        } catch (ValidationException $exception) {
            Log::error($exception->getMessage());
            $this->addError('email', $exception->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.employees.login-form');
    }
}
