<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <h2 class="text-xl font-semibold mb-6 text-center">{{ __('Reset Password') }}</h2>

        <div class="mb-4 text-sm">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required
                autofocus />
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between mb-6">
            <a class="auth-link text-sm" href="{{ route('login') }}">
                {{ __('Back to login') }}
            </a>
        </div>

        <button type="submit" class="auth-button">
            {{ __('Email Password Reset Link') }}
        </button>
    </form>
</x-guest-layout>
