<nav x-data="{ open: false, showNotifications: false }" class="relative z-50 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 overflow-visible">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div> 

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pet.details')" :active="request()->routeIs('pet.details')">
                        {{ __('Pet Details') }}
                    </x-nav-link>
                    <x-nav-link :href="route('vet.details')" :active="request()->routeIs('vet.details')">
                        {{ __('Vet details') }}
                    </x-nav-link>
                    <x-nav-link :href="route('vaccination.details')" :active="request()->routeIs('vaccination.details')">
                        {{ __('Vaccination details') }}
                    </x-nav-link>
                    <x-nav-link :href="route('consultation.details')" :active="request()->routeIs('consultation.details')">
                        {{ __('Consultation details') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings + Notification -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4 sm:ms-6 relative overflow-visible">
                <!-- Notification Bell -->
                <div class="relative">
                    <button @click="showNotifications = !showNotifications" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        🔔
                    </button>
                    <div x-show="showNotifications" @click.outside="showNotifications = false"
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg py-3 px-4 z-50 text-gray-700 dark:text-gray-200 text-sm max-h-72 overflow-y-auto">
                        @if(isset($userNotifications) && $userNotifications->count())
                            <ul class="space-y-2">
                                @foreach($userNotifications as $note)
                                    <li class="text-sm border-b pb-1">
                                        <strong>{{ $note->pet->name ?? 'Pet' }}:</strong> {{ $note->message }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-center">No Notifications</div>
                        @endif
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
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
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" x-data="{ showNotifications: false }">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pet.details')" :active="request()->routeIs('pet.details')">
                {{ __('Pet Details') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('vet.details')" :active="request()->routeIs('vet.details')">
                {{ __('Vet details') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('vaccination.details')" :active="request()->routeIs('vaccination.details')">
                {{ __('Vaccination details') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('consultation.details')" :active="request()->routeIs('consultation.details')">
                {{ __('Consultation details') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Notification Bell -->
        <div class="border-t border-gray-200 dark:border-gray-600 px-4 py-2 relative">
            <button @click="showNotifications = !showNotifications" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                🔔
            </button>
            <div x-show="showNotifications" @click.outside="showNotifications = false"
                class="absolute right-4 mt-2 w-64 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg py-3 px-4 z-50 text-gray-700 dark:text-gray-200 text-sm max-h-72 overflow-y-auto">
                @if(isset($userNotifications) && $userNotifications->count())
                    <ul class="space-y-2">
                        @foreach($userNotifications as $note)
                            <li class="text-sm border-b pb-1">
                                <strong>{{ $note->pet->name ?? 'Pet' }}:</strong> {{ $note->message }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center">No Notifications</div>
                @endif
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
