<nav x-data="{ open: false, dropdown: false }" class="bg-white/90 backdrop-blur border-b border-gray-200 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo + Site Name -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png"
                         alt="Food Forum Logo"
                         class="h-9 w-auto">
                    <span class="font-bold text-xl text-black">Food Forum</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex space-x-8 font-medium">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-black">
                    {{ __('หน้าแรก') }}
                </x-nav-link>

                <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')" class="text-black">
                    {{ __('กระทู้') }}
                </x-nav-link>

                <x-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')" class="text-black">
                    {{ __('สร้างกระทู้') }}
                </x-nav-link>
            </div>

            <!-- Auth Section -->
            <div class="hidden sm:flex items-center space-x-4">
                @auth
                    <!-- User Name + Dropdown -->
                    <div class="relative">
                        <button @click="dropdown = !dropdown"
                                class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition">
                            <span class="text-black font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="dropdown"
                             @click.away="dropdown = false"
                             class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50">
                            <div class="px-4 py-2 text-sm text-black font-semibold border-b">
                                {{ Auth::user()->name }}
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-logout">
                                    ออกจากระบบ
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- If not logged in -->
                    <a href="{{ route('login') }}" class="btn btn-login">
                        เข้าสู่ระบบ
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-register">
                        สมัครสมาชิก
                    </a>
                @endauth
            </div>

            <!-- Hamburger Menu (มือถือ) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-black hover:bg-gray-200 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-3 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-black">
                {{ __('หน้าแรก') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.*')" class="text-black">
                {{ __('กระทู้') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')" class="text-black">
                {{ __('สร้างกระทู้') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Auth Section -->
        <div class="border-t border-gray-200 pt-4 pb-4">
            @auth
                <div class="px-4 py-2 text-black font-semibold">
                    {{ Auth::user()->name }}
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2 px-4">
                    @csrf
                    <button type="submit" class="btn-logout w-full text-center">
                        ออกจากระบบ
                    </button>
                </form>
            @else
                <div class="px-4 space-y-2">
                    <a href="{{ route('login') }}" class="btn btn-login block w-full text-center">
                        เข้าสู่ระบบ
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-register block w-full text-center">
                        สมัครสมาชิก
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
