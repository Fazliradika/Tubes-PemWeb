<nav x-data="{ open: false }" class="glass-nav backdrop-blur-xl bg-white/85 dark:bg-slate-900/90 border-b border-blue-100 dark:border-blue-900/50 shadow-sm sticky top-0 z-50 transition-colors duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/LOGO_HealthFirst.png') }}" alt="HealthFirst Medical Logo" class="h-16 w-auto object-contain">
                        <span class="text-xl font-bold text-blue-600 dark:text-blue-400">HealthFirst Medical</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        {{ __('Dashboard') }}
                    </a>
                    
                    <!-- E-Commerce Links - Only for Patient and Admin -->
                    @if(auth()->check() && !auth()->user()->isDoctor())
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products.*') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        <i class="fas fa-shopping-bag mr-1"></i>{{ __('Belanja') }}
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('cart.*') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        <i class="fas fa-shopping-cart mr-1"></i>{{ __('Keranjang') }}
                    </a>
                    
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('orders.*') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        <i class="fas fa-receipt mr-1"></i>{{ __('Pesanan') }}
                    </a>
                    @endif
                    
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.orders.*') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        <i class="fas fa-tasks mr-1"></i>{{ __('Kelola Pesanan') }}
                    </a>

                    <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.articles.*') ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:border-blue-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        <i class="fas fa-newspaper mr-1"></i>{{ __('Kelola Artikel') }}
                    </a>
                    @endif
                </div>
            </div>

            <!-- Right Side: Dark Mode Toggle & User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode" 
                        class="dark-mode-toggle relative inline-flex items-center cursor-pointer"
                        :class="darkMode ? 'bg-blue-600' : 'bg-slate-300'"
                        aria-label="Toggle dark mode">
                    <span class="sr-only">Toggle dark mode</span>
                    <span class="toggle-circle bg-white shadow-lg"
                          :class="darkMode ? 'translate-x-7' : 'translate-x-0'">
                        <!-- Sun Icon -->
                        <svg x-show="!darkMode" class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                        </svg>
                        <!-- Moon Icon -->
                        <svg x-show="darkMode" x-cloak class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </span>
                </button>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-blue-200 dark:border-blue-700 text-sm leading-4 font-medium rounded-xl text-slate-700 dark:text-slate-200 bg-white/50 dark:bg-slate-800/50 hover:bg-blue-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition ease-in-out duration-150 backdrop-blur-sm shadow-sm">
                            <div class="font-semibold">{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
            <div class="-me-2 flex items-center sm:hidden space-x-3">
                <!-- Mobile Dark Mode Toggle -->
                <button @click="darkMode = !darkMode" 
                        class="p-2 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition"
                        aria-label="Toggle dark mode">
                    <svg x-show="!darkMode" class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                    </svg>
                    <svg x-show="darkMode" x-cloak class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                    </svg>
                </button>
                
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
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
        <div class="pt-2 pb-3 space-y-1 bg-white/90 dark:bg-slate-900/95 backdrop-blur-lg">
            <a href="{{ route('dashboard') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-800 hover:border-blue-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                {{ __('Dashboard') }}
            </a>
            
            <!-- E-Commerce Links Mobile - Only for Patient and Admin -->
            @if(auth()->check() && !auth()->user()->isDoctor())
            <a href="{{ route('products.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('products.*') ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-800 hover:border-blue-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                <i class="fas fa-shopping-bag mr-2"></i>{{ __('Belanja') }}
            </a>
            
            <a href="{{ route('cart.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('cart.*') ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-800 hover:border-blue-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                <i class="fas fa-shopping-cart mr-2"></i>{{ __('Keranjang') }}
            </a>
            
            <a href="{{ route('orders.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('orders.*') ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-800 hover:border-blue-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                <i class="fas fa-receipt mr-2"></i>{{ __('Pesanan') }}
            </a>
            @endif
            
            @if(auth()->check() && auth()->user()->isAdmin())
            <a href="{{ route('admin.orders.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('admin.orders.*') ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-800 hover:border-blue-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                <i class="fas fa-tasks mr-2"></i>{{ __('Kelola Pesanan') }}
            </a>
            
            <a href="{{ route('admin.articles.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 {{ request()->routeIs('admin.articles.*') ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400' : 'border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-800 hover:border-blue-300' }} text-start text-base font-medium transition duration-150 ease-in-out">
                <i class="fas fa-newspaper mr-2"></i>{{ __('Kelola Artikel') }}
            </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-blue-100 dark:border-blue-900/50 bg-white/90 dark:bg-slate-900/95 backdrop-blur-lg">
            <div class="px-4">
                <div class="font-medium text-base text-slate-700 dark:text-slate-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-slate-600 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-800 hover:border-blue-300 text-start text-base font-medium transition duration-150 ease-in-out">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-slate-600 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:border-red-300 text-start text-base font-medium transition duration-150 ease-in-out">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    [x-cloak] { display: none !important; }
</style>
