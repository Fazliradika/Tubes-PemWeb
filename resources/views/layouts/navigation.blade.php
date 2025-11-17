<!-- Service Icons Section (Halodoc Style) -->
<div class="bg-white border-b border-gray-200 py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-center space-x-2 md:space-x-4 overflow-x-auto">
            @auth
                @if(auth()->user()->role === 'patient')
                <a href="{{ route('chat.index') }}" class="flex flex-col items-center justify-center min-w-[80px] p-2 rounded-lg hover:bg-pink-50 transition group">
                    <div class="w-12 h-12 bg-gradient-to-br from-pink-100 to-pink-200 rounded-xl flex items-center justify-center mb-1 group-hover:scale-110 transition">
                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <span class="text-xs text-gray-700 text-center">Chat dengan Dokter</span>
                </a>
                @endif
            @endauth

            <a href="#" class="flex flex-col items-center justify-center min-w-[80px] p-2 rounded-lg hover:bg-pink-50 transition group">
                <div class="w-12 h-12 bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center mb-1 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="text-xs text-gray-700 text-center">Toko Kesehatan</span>
            </a>

            <a href="#" class="flex flex-col items-center justify-center min-w-[80px] p-2 rounded-lg hover:bg-pink-50 transition group">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center mb-1 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <span class="text-xs text-gray-700 text-center">Homecare</span>
            </a>

            <a href="#" class="flex flex-col items-center justify-center min-w-[80px] p-2 rounded-lg hover:bg-pink-50 transition group">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center mb-1 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <span class="text-xs text-gray-700 text-center">Asuransiku</span>
            </a>

            <a href="#" class="flex flex-col items-center justify-center min-w-[80px] p-2 rounded-lg hover:bg-pink-50 transition group">
                <div class="w-12 h-12 bg-gradient-to-br from-pink-100 to-pink-200 rounded-xl flex items-center justify-center mb-1 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs text-gray-700 text-center">Haloskin</span>
            </a>

            <a href="#" class="flex flex-col items-center justify-center min-w-[80px] p-2 rounded-lg hover:bg-pink-50 transition group">
                <div class="w-12 h-12 bg-gradient-to-br from-teal-100 to-teal-200 rounded-xl flex items-center justify-center mb-1 group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <span class="text-xs text-gray-700 text-center">Halofit</span>
            </a>
        </div>
    </div>
</div>

<nav x-data="{ open: false }" class="bg-gradient-to-r from-gray-800 to-gray-900 border-b border-gray-700 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/LogoRs.png') }}" alt="Hospital Logo" class="h-10 w-auto">
                        <span class="text-xl font-bold text-white">HealthFirst Medical</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <!-- E-Commerce Links - Only for Patient and Admin -->
                    @if(auth()->check() && !auth()->user()->isDoctor())
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        <i class="fas fa-shopping-bag mr-1"></i>{{ __('Belanja') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">
                        <i class="fas fa-shopping-cart mr-1"></i>{{ __('Keranjang') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                        <i class="fas fa-receipt mr-1"></i>{{ __('Pesanan') }}
                    </x-nav-link>
                    @endif
                    
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                        <i class="fas fa-tasks mr-1"></i>{{ __('Kelola Pesanan') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-gray-600 text-sm leading-4 font-medium rounded-md text-white bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition ease-in-out duration-150">
                            <div class="font-semibold">{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <!-- E-Commerce Links Mobile - Only for Patient and Admin -->
            @if(auth()->check() && !auth()->user()->isDoctor())
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                <i class="fas fa-shopping-bag mr-2"></i>{{ __('Belanja') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">
                <i class="fas fa-shopping-cart mr-2"></i>{{ __('Keranjang') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                <i class="fas fa-receipt mr-2"></i>{{ __('Pesanan') }}
            </x-responsive-nav-link>
            @endif
            
            @if(auth()->check() && auth()->user()->isAdmin())
            <x-responsive-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                <i class="fas fa-tasks mr-2"></i>{{ __('Kelola Pesanan') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700 bg-gray-800">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
