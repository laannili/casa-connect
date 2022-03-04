<x-layouts.base>
    {{-- If the user is authenticated --}}
    @auth()
        {{-- If the user is authenticated on the sign up page --}}
        @if (in_array(request()->route()->getName(),['sign-up'],))
            @include('layouts.navbars.guest.sign-up')
            {{ $slot }}
            @include('layouts.footers.guest.description')
            {{-- If the user is authenticated on the login page --}}
        @elseif (in_array(request()->route()->getName(),['sign-in', 'login'],))
            @include('layouts.navbars.guest.login')
            {{ $slot }}
            @include('layouts.footers.guest.description')
        @elseif (in_array(request()->route()->getName(),['profile', 'my-profile'],))
            @include('layouts.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100">
                @include('layouts.navbars.auth.nav')
                <div>
                    {{ $slot }}
                    @include('layouts.footers.footer')
                </div>
            </div>
        @elseif(isset($slot))
            @include('layouts.navbars.auth.sidebar')
            @include('layouts.navbars.auth.nav')
            {{ $slot }}
            <main>
                <div class="container-fluid">
                    <div class="row">
                        @include('layouts.footers.footer')
                    </div>
                </div>
            </main>
        @else
            @include('layouts.navbars.auth.sidebar')
            @include('layouts.navbars.auth.nav')
            <main>
                <div class="container-fluid">
                    <div class="row">
                        @include('layouts.footers.footer')
                    </div>
                </div>
            </main>
        @endif
    @endauth

    {{-- If the user is not authenticated (if the user is a guest) --}}
    @guest
        {{-- If the user is on the dashboard page --}}
        @if (isset($slot))
            {{ $slot }}
            <main>
                <div class="container-fluid">
                    <div class="row">
                        @include('layouts.footers.guest.description')
                    </div>
                </div>
            </main>
        @else
            <main>
                <div class="container-fluid">
                    <div class="row">
                        @include('layouts.footers.guest.description')
                    </div>
                </div>
            </main>
        @endif
    @endguest

</x-layouts.base>