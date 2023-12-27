<nav class="bg-red-900">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-4 md:px-6 lg:px-6">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 md:-my-px md:ml-10 md:flex ">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                @if(auth()->check() && auth()->user()->hasRole('Postulante'))
                <div class="hidden space-x-8 md:-my-px md:ml-10 md:flex">
                    <x-nav-link :href="route('preinscripcion.index')" :active="request()->routeIs('preinscripcion.index')">
                        {{ __('Pre-inscripcion') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 md:-my-px md:ml-10 md:flex">
                    <x-nav-link :href="route('formulario')" :active="request()->routeIs('formulario')">
                        {{ __('formulario') }}
                    </x-nav-link>
                </div>
                @endif

                @if(auth()->check() && auth()->user()->hasRole('Secretaria'))
                <div class="hidden md:flex md:items-center md:ml-6">
                    <x-dropdown aling="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-100 bg-red-900 hover:text-red-300 hover:border-red-700 dark:hover:border-red-100 focus:outline-none transition ease-in-out duration-150">
                            <div>{{__('Secretaria')}}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('secretaria.index')" :active="request()->routeIs('secretaria.index')">
                        {{ __('Lista Pre-inscritos') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('secretaria.postulantes')" :active="request()->routeIs('secretaria.postulantes')">
                            {{ __('Lista Postulantes') }}
                            </x-dropdown-link>
                        <x-dropdown-link :href="route('secretaria.reporte')" :active="request()->routeIs('secretaria.reporte')">
                            {{ __('Reporte usuarios') }}
                        </x-dropdown-link>

                    </x-slot>
                    </x-dropdown>
                </div>
                @endif

                @if(auth()->check() && auth()->user()->hasRole('Evaluador'))
                <div class="hidden md:flex md:items-center md:ml-6">
                    <x-dropdown aling="right" width="48">
                    <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-100 bg-red-900 hover:text-red-300 hover:border-red-700 dark:hover:border-red-100 focus:outline-none transition ease-in-out duration-150">
                            <div>{{__('Evaluador')}}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('evaluador.index')" :active="request()->routeIs('secretaria.index')">
                        {{ __('Lista usuarios') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('evaluador.reporte')" :active="request()->routeIs('secretaria.reporte')">
                            {{ __('Reporte usuarios') }}
                        </x-dropdown-link>

                    </x-slot>
                    </x-dropdown>
                </div>
                @endif

                @if(auth()->check() && auth()->user()->hasRole('Contador'))
                <div class="hidden md:flex md:items-center md:ml-6">
                    <x-dropdown aling="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-100 bg-red-900 hover:text-red-300 hover:border-red-700 dark:hover:border-red-100 focus:outline-none transition ease-in-out duration-150">
                            <div>{{__('Contador')}}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('contador.index')" :active="request()->routeIs('contador.index')">
                        {{ __('Postulantes pago') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('contador.pagos')" :active="request()->routeIs('contador.pagos')">
                            {{ __('Subir pagos') }}
                            </x-dropdown-link>
                    </x-slot>
                    </x-dropdown>
                </div>
                @endif

                @if(auth()->check() && auth()->user()->hasRole('Admin'))
                <div class="hidden md:flex md:items-center md:ml-6">
                    <x-dropdown aling="right" width="48">
                    <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-100 bg-red-900 hover:text-red-300 hover:border-red-700 dark:hover:border-red-100 focus:outline-none transition ease-in-out duration-150">
                            <div>{{__('Admin')}}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                        {{ __('Control de Usuarios') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">
                        {{ __('Roles') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.convocatoria.index')" :active="request()->routeIs('admin.convocatoria.index')">
                            {{ __('Convocatorias') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.procesos.index')" :active="request()->routeIs('admin.procesos.index')">
                            {{ __('Procesos') }}
                        </x-dropdown-link>
                    </x-slot>
                    </x-dropdown>
                </div>
                @endif

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden md:flex md:items-center md:ml-6">
                <x-dropdown aling="right" width="48">
                    <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-100 bg-red-900 hover:text-red-300 hover:border-red-700 dark:hover:border-red-100 focus:outline-none transition ease-in-out duration-150">
                        @if (Auth::check())
                            <div>{{ Auth::user()->nombres }}</div>
                        @endif
                            <div class="ml-1">
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
                <!--Boton para controlar el modo oscuro-modo claro -->
                    <button type="button" @click="isDarkMode =! isDarkMode">
                        <span x-show="isDarkMode">
                            <img width="20" height="20" src="https://img.icons8.com/ios/50/sun--v1.png" alt="Modo claro" style="filter: invert(100%);"/>
                        </span>
                        <span x-show="!isDarkMode">
                            <img width="20" height="20" src="https://img.icons8.com/fluency-systems-filled/48/000000/crescent-moon.png" alt="Modo ocuro" style="filter: invert(100%);"/>
                        </span>
                    </button>
            </div>

    <!-- Hamburger -->
    <div class="-mr-2 flex items-center md:hidden">

        <button @click="Menu()" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-red-800 focus:outline-none focus:bg-red-800 focus:text-red-400 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': !open, 'inline-flex': open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" style="stroke: white;" />
                <path :class="{'hidden': open, 'inline-flex': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="stroke: white;" />
            </svg>
        </button>

        <!--Botón para controlar el modo oscuro-modo claro -->
        <button type="button" @click="isDarkMode =! isDarkMode">
                        <span x-show="isDarkMode">
                            <img width="20" height="20" src="https://img.icons8.com/ios/50/sun--v1.png" alt="Modo claro" style="filter: invert(100%);"/>
                        </span>
                        <span x-show="!isDarkMode">
                            <img width="20" height="20" src="https://img.icons8.com/fluency-systems-filled/48/000000/crescent-moon.png" alt="Modo ocuro" style="filter: invert(100%);"/>
                        </span>
        </button>
    </div>

    <!-- Responsive Navigation Menu -->
    <div id="responsive-menu" :class="{'block': !open, 'hidden': open}" class="hidden md:hidden absolute top-16 left-0 z-50 bg-red-900 h-full w-300">
        <div class="pt-2 pb-3 space-y-1  bg-red-900">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        @if(auth()->check() && auth()->user()->hasRole('Postulante'))
        <div class="pt-4 pb-1 border-t  bg-red-900 border-gray-200 dark:border-gray-600">

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('preinscripcion.index')" :active="request()->routeIs('preinscripcion.index')">
                {{ __('Pre-inscripcion') }}
                </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('formulario')" :active="request()->routeIs('formulario')">
                {{ __('formulario') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->hasRole('Admin'))
        <div class="pt-4 pb-1 border-t  bg-red-900 border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{__('Admin')}}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                        {{ __('Control de Usuarios') }}
                </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">
                        {{ __('Roles') }}
                </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.convocatoria.index')" :active="request()->routeIs('admin.convocatoria.index')">
                        {{ __('Convocatorias') }}
                </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('admin.procesos.index')" :active="request()->routeIs('admin.procesos.index')">
                        {{ __('Procesos') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->hasRole('Secretaria'))
        <div class="pt-4 pb-1 border-t  bg-red-900 border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{__('Secretaria')}}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('secretaria.index')" :active="request()->routeIs('secretaria.index')">
                        {{ __('Lista Pre-inscritos') }}
                </x-responsive-nav-link>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('secretaria.postulantes')" :active="request()->routeIs('secretaria.index')">
                {{ __('Lista Postulantes') }}
                </x-responsive-nav-link>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('secretaria.reporte')" :active="request()->routeIs('secretaria.reporte')">
                        {{ __('Reporte usuarios') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->hasRole('Evaluador'))
        <div class="pt-4 pb-1 border-t  bg-red-900 border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{__('Evaluador')}}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('evaluador.index')" :active="request()->routeIs('evaluador.index')">
                        {{ __('Lista usuarios') }}
                </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('evaluador.reporte')" :active="request()->routeIs('evaluador.index')">
                        {{ __('Reporte usuarios') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endif

        @if(auth()->check() && auth()->user()->hasRole('Contador'))
        <div class="pt-4 pb-1 border-t  bg-red-900 border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-200">{{__('Contador')}}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('contador.index')" :active="request()->routeIs('contador.index')">
                        {{ __('Lista usuarios') }}
                </x-responsive-nav-link>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('contador.pagos')" :active="request()->routeIs('contador.pagos')">
                        {{ __('Subida Pagos de usuarios') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @endif

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t  bg-red-900 border-gray-200 dark:border-gray-600">
            <div class="px-4">
                @if (Auth::check())
                    <div class="font-medium text-base text-gray-200">{{ Auth::user()->nombres }}</div>
                    <div class="font-medium text-md text-red-500">{{ Auth::user()->email }}</div>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            @click="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</div>
</nav>
<script>
    function Menu() {
        var menu = document.getElementById('responsive-menu');
        menu.classList.toggle('hidden');
    }
</script>
