<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome!") }}
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <!-- View Campaigns Card -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold text-lg">Campaigns</h3>
                    <p>View all fundraising campaigns.</p>
                    <a href="{{ route('campaigns.index') }}" class="mt-2 inline-block text-blue-600 hover:underline">View Campaigns</a>
                </div>

                <!-- View Donations Card -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold text-lg">Donations</h3>
                    <p>Check your past donations.</p>
                    <a href="{{ route('donations.index') }}" class="mt-2 inline-block text-blue-600 hover:underline">View Donations</a>
                </div>

                <!-- Create Campaign Card -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold text-lg">Create Campaign</h3>
                    <p>Start a new fundraising campaign.</p>
                    <a href="{{ route('campaigns.create') }}" class="mt-2 inline-block text-blue-600 hover:underline">Create Campaign</a>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
