<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-xl font-semibold mb-6 text-center">{{ __('Create an Account') }}</h2>

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required
                autofocus autocomplete="name" />
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required
                autocomplete="username" />
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-input" type="password" name="password" required
                autocomplete="new-password" />
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required
                autocomplete="new-password" />
            @error('password_confirmation')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between mb-6">
            <a class="auth-link text-sm" href="{{ route('login') }}">
                {{ __('Already have an account?') }}
            </a>
        </div>

        <button type="submit" class="auth-button">
            {{ __('Register') }}
        </button>
    </form>
</x-guest-layout>
