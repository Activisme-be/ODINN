<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}"/>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar bg-navbar navbar-expand-lg navbar-dark">
                <img src="{{ asset('img/logo.jpg') }}" width="35" height="35" class="mr-3 rounded d-inline-block align-top" alt="{{ config('app.name', 'Laravel') }}">
                <a class="navbar-brand mr-auto mr-lg-0" href="#">
                    {{ config('app.name', 'Laravel') }} - ODINN
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="mailto:tim@activisme.be" class="nav-link">
                                <i class="fe fe-info text-white mr-2"></i> Help
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.settings.info') }}">
                                <i class="fe fe-user text-white mr-2"></i>{{ ucfirst($currentUser->name) }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="" class="text-danger nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ml-2 fe fe-power"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="nav-scroller bg-white shadow-sm">
                <nav class="nav nav-underline">
                    @if ($currentUser->hasAnyRole(['admin', 'webmaster']))
                        <a href="{{ route('home') }}" class="{{ active('home') }} nav-link">
                            <i class="fe fe-home mr-1 text-muted"></i> Dashboard
                        </a>

                        <a href="{{ route('users.index') }}" class="{{ active('users.*') }} nav-link">
                            <i class="fe fe-users mr-1 text-muted"></i> Gebruikers
                        </a>

                        <a href="{{ route('locations.index') }}" class="{{ active('locations.*') }} nav-link">
                            <i class="fe fe-map-pin mr-1 text-muted"></i> Locaties
                        </a>

                        <a href="{{ route('tags.overview') }}" class="nav-link {{ active('tags.*') }}">
                            <i class="fe fe-tag mr-1 text-muted"></i> Categorieen
                        </a>

                        <a href="{{ route('inventory.admin.index') }}" class="{{ active('inventory.*') }} nav-link">
                            <i class="fe fe-list mr-1 text-muted"></i> Inventaris
                        </a>
                    @endif

                    {{-- Coordinator section of the navbar --}}
                    @if ($currentUser->hasRole('vrijwilliger') && ! $currentUser->hasAnyRole(['admin', 'webmaster']))
                        <a href="{{ route('coordinator.home') }}" class="{{ active(['coordinator.home', 'coordinator.inventory.*']) }} nav-link">
                            <i class="fe fe-list mr-1 text-muted"></i> Inventaris
                        </a>

                        <a href="{{ route('locations.show', $currentUser->location) }}" class="nav-link">
                            <i class="fe fe-map-pin mr-1 text-muted"></i> Inzamelpunt
                        </a>
                    @endif
                </nav>
            </div>

            <main role="main">
                @yield('content')
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <span class="footer-text font-weight-bold">&copy; 2019 - {{ date('Y') }} <span class="ml-1">{{ config('app.name') }}</span></span>

                    <div class="float-right">
                        <a class="text-decoration-none footer-link" id="toTop" href="#">
                            <i class="fe font-weight-bold fe-chevrons-up icon-pl-1"></i> Naar boven
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
