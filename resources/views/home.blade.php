<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-4">Welcome to Our Pet Portal!</h1>
                <p class="mb-4">This website helps you manage and view information about your beloved pets.</p>
                <p>Check out your pets on the <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">Dashboard</a>.</p>
                </div>
        </div>
    </div>
</x-app-layout>