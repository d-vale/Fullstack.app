<div class="dark:hidden">
    <!-- Logo pour le mode clair -->
    <img src="{{ Vite::asset('resources/assets/images/icon.png') }}" alt="Logo" {{ $attributes }} />
</div>
<div class="hidden dark:block">
    <!-- Logo pour le mode sombre -->
    <img src="{{ Vite::asset('resources/assets/images/icon-dark.png') }}" alt="Logo" {{ $attributes }} />
</div>
