<nav x-data="{ open: false }" class="glass-nav backdrop-blur-xl bg-white/70 border-b border-emerald-200/50 shadow-lg shadow-emerald-500/5 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/LogoRs.png') }}" alt="Hospital Logo" class="h-10 w-auto">
                        <span class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">HealthFirst Medical</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-emerald-500 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        {{ __('Dashboard') }}
                    </a>
                    
                    <!-- E-Commerce Links - Only for Patient and Admin -->
                    @if(auth()->check() && !auth()->user()->isDoctor())
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products.*') ? 'border-emerald-500 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        <i class="fas fa-shopping-bag mr-1"></i>{{ __('Belanja') }}
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('cart.*') ? 'border-emerald-500 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        <i class="fas fa-shopping-cart mr-1"></i>{{ __('Keranjang') }}
                    </a>
                    
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('orders.*') ? 'border-emerald-500 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        <i class="fas fa-receipt mr-1"></i>{{ __('Pesanan') }}
                    </a>
                    @endif
                    
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.orders.*') ? 'border-emerald-500 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:border-emerald-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        <i class="fas fa-tasks mr-1"></i>{{ __('Kelola Pesanan') }}
                    </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-emerald-200 text-sm leading-4 font-medium rounded-xl text-emerald-700 bg-white/50 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition ease-in-out duration-150 backdrop-blur-sm shadow-sm">
                            <div class="font-semibold">{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-emerald-600 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition duration-150 ease-in-out">
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
        <div class="pt-2 pb-3 space-y-1 bg-white/80 backdrop-blur-lg">
            <a href="{{ route('dashboard') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 hover:border-emerald-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                {{ __('Dashboard') }}
            </a>
            
            <!-- E-Commerce Links Mobile - Only for Patient and Admin -->
            @if(auth()->check() && !auth()->user()->isDoctor())
            <a href="{{ route('products.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('products.*') ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 hover:border-emerald-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                <i class="fas fa-shopping-bag mr-2"></i>{{ __('Belanja') }}
            </a>
            
            <a href="{{ route('cart.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('cart.*') ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 hover:border-emerald-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                <i class="fas fa-shopping-cart mr-2"></i>{{ __('Keranjang') }}
            </a>
            
            <a href="{{ route('orders.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('orders.*') ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 hover:border-emerald-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                <i class="fas fa-receipt mr-2"></i>{{ __('Pesanan') }}
            </a>
            @endif
            
            @if(auth()->check() && auth()->user()->isAdmin())
            <a href="{{ route('admin.orders.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('admin.orders.*') ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : 'border-transparent text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 hover:border-emerald-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                <i class="fas fa-tasks mr-2"></i>{{ __('Kelola Pesanan') }}
            </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-emerald-200/50 bg-white/80 backdrop-blur-lg">
            <div class="px-4">
                <div class="font-medium text-base text-emerald-700">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 hover:border-emerald-300 text-start text-base font-medium transition duration-150 ease-in-out">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-red-600 hover:bg-red-50 hover:border-red-300 text-start text-base font-medium transition duration-150 ease-in-out">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
