<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h2 class="text-xl font-semibold mb-6 text-center">{{ __('Log In to Your Account') }}</h2>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required
                autofocus autocomplete="username" />
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-input" type="password" name="password" required
                autocomplete="current-password" />
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-4 flex items-center">
            <input id="remember_me" type="checkbox"
                class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring-primary"
                name="remember">
            <label for="remember_me"
                class="ms-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Remember me') }}</label>
        </div>

        <div class="flex items-center justify-between mb-6">
            @if (Route::has('password.request'))
                <a class="auth-link text-sm" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <a class="auth-link text-sm" href="{{ route('register') }}">
                {{ __("Don't have an account?") }}
            </a>
        </div>

        <button type="submit" class="auth-button">
            {{ __('Log in') }}
        </button>
    </form>
</x-guest-layout>
