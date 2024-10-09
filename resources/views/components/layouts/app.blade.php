<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <x-spotlight />
    {{-- The navbar with `sticky` and `full-width` --}}
    @auth
    <x-nav sticky full-width>

        <x-slot:brand>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            <div>Bloggo</div>
        </x-slot:brand>
        <x-slot:actions>
            <x-theme-toggle class="btn btn-circle btn-ghost" />
            <x-button label="Facebook" icon="fab.facebook" external link="{{ config('constants.social_links.facebook') }}" class="btn-ghost btn-sm" responsive />
            <x-button label="Github" icon="fab.github" external link="{{ config('constants.social_links.github') }}" class="btn-ghost btn-sm" responsive />
        </x-slot:actions>
    </x-nav>
    @else
    <div class="navbar">
        <div class="flex-1">
            <a href="{{ route('welcome') }}" class="ml-4">
                <img id="logo-light" src="{{ asset('icon/bloggo-light.png') }}" width="150px" alt="Bloggo Logo" class="hidden dark:block">
                <img id="logo-dark" src="{{ asset('icon/bloggo-dark.png') }}" width="150px" alt="Bloggo Logo" class="block dark:hidden">
            </a>
        </div>

        <div class="flex-none">
            <x-theme-toggle class="btn btn-circle btn-ghost" />
            <x-button label="Facebook" icon="fab.facebook" external link="{{ config('constants.social_links.facebook') }}" class="btn-ghost text-blue-500 btn-sm" responsive wire.navigate />
            <x-button label="Github" icon="fab.github" external link="{{ config('constants.social_links.github') }}" class="btn-ghost dark:text-white text-black btn-sm" responsive />
        </div>
    </div>
    @endauth


    {{-- The main content with `full-width` --}}
    <x-main with-nav full-width>

        {{-- This is a sidebar that works also as a drawer on small screens --}}
        {{-- Notice the `main-drawer` reference here --}}
        @if($user = auth()->user())
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">

            {{-- User --}}
                <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="pt-2">
                    <x-slot:actions>
                        <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="Logout" no-wire-navigate link="/logout" />
                    </x-slot:actions>
                </x-list-item>

                <x-menu-separator />

                {{-- Activates the menu item when a route matches the `link` property --}}
                <x-menu activate-by-route>
                    <x-menu-item title="Home" icon="o-home" link="{{ route('home') }}" />
                    <x-menu-sub title="Posts" icon="o-document">
                        <x-menu-item title="List post" icon="o-queue-list" link="{{ route('post.index') }}" />
                        <x-menu-item title="Create post" icon="o-plus" link="{{ route('post.create') }}" />
                        <x-menu-item title="Archives" icon="o-archive-box" link="{{ route('post.archive') }}" />
                    </x-menu-sub>
                </x-menu>
            </x-slot:sidebar>
        @endif

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
    <div class="fixed bottom-4 right-4">
        <button id="go-to-top" class="bg-pink-200 hover:bg-pink-400 dark:bg-blue-400 dark:hover:bg-blue-600 hover:duration-200 text-white font-bold px-3 py-2 rounded-full shadow-lg">
            <x-icon name="o-arrow-up" class="text-white" />
      </button>
    </div>
</body>
<script>
    document.getElementById('go-to-top').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // document.addEventListener('DOMContentLoaded', function () {
    //     const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

    //     function updateLogo() {
    //         if (darkModeMediaQuery.matches) {
    //             document.getElementById('logo-light').classList.add('hidden');
    //             document.getElementById('logo-dark').classList.remove('hidden');
    //         } else {
    //             document.getElementById('logo-light').classList.remove('hidden');
    //             document.getElementById('logo-dark').classList.add('hidden');
    //         }
    //     }
    //     updateLogo();
    //     // Listen for changes in the color scheme
    //     darkModeMediaQuery.addEventListener('change', updateLogo);
    // });
</script>
</html>
