<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Campaign: ') . $campaign->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Details</h3>
                    <p><strong>Description:</strong> {{ $campaign->description }}</p>
                    <p><strong>Target Amount:</strong> ${{ number_format($campaign->target_amount, 2) }}</p>
                    <p><strong>Current Amount:</strong> ${{ number_format($campaign->current_amount, 2) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($campaign->status) }}</p>

                    <div class="mt-4">
                        <a href="{{ route('campaigns.index') }}" class="text-blue-600 hover:underline">Back to Campaigns</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
