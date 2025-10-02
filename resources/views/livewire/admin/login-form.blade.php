<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')"/>

{{-- Success Flash Message --}}
@if (session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<form wire:submit="login">
    @csrf

    <!-- Email Address -->
    <div>
        <x-input-label :value="__('Email')"/>
        <x-text-input id="email" class="block mt-1 w-full" type="email" wire:model.live.debounce.300ms="email" :disabled="$isLoading"
        required autofocus autocomplete="username" />
       @error('email')
        <span class="text-sm text-red-600 space-y-1">{{$message}}</span>
{{--        <x-input-error :messages="{{[$message}}" class="mt-2"/>--}}
       @enderror
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')"/>

        <x-text-input id="password" class="block mt-1 w-full"
                      type="password"
                      wire:model="password"
                      required autocomplete="current-password"/>
        @error('password')
        <span class="text-sm text-red-600 space-y-1">{{$message}}</span>
{{--        <x-input-error :messages="{{$message}}" class="mt-2"/>--}}
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox"
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                   wire:model="remember">
            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <x-primary-button class="ms-3">
            {{ __('Log in') }}
        </x-primary-button>
    </div>
</form>
