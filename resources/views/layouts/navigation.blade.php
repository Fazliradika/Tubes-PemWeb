<nav x-data="{ open: false }" class="bg-gradient-to-r from-gray-800 to-gray-900 border-b border-gray-700 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
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
