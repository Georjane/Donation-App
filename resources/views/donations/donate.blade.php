<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donate to Campaign: ' . $campaign->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Make a Donation</h3>
                    <p class="mt-2">Fill in the amount you wish to donate to this campaign.</p>
                </div>
            </div>

            <div class="mt-6">
                <form action="{{ route('campaigns.donate', $campaign->id) }}" method="POST">
                    @csrf <!-- CSRF protection -->

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="mb-4">
                            <label for="amount" class="block text-gray-700 font-bold mb-2">Donation Amount</label>
                            <input type="number" id="amount" name="amount" required min="1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Donate
                            </button>
                            <a href="{{ route('campaigns.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
