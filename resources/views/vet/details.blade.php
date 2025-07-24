<x-app-layout>
    {{-- HEADER SECTION --}}
    <div style="margin: 30px 0;">
        <div style="background-color: rgba(6, 95, 70, 1); padding: 20px; border-radius: 10px; text-align: center;">
            <h1 style="font-size: 2rem; font-weight: bold; color: white;">
                Discover Trusted Veterinary Services in Goa
            </h1>
        </div>
    </div>

    {{-- FILTER SECTION --}}
    <div style="margin-bottom: 30px;" class="max-w-7xl mx-auto sm:px-6 lg:px-15">
        <form method="GET" action="{{ route('vet.details') }}" class="flex flex-wrap items-center gap-4">
            <label for="region" class="text-gray-800 font-semibold">Filter by District:</label>
            <select id="region" name="region" style="padding: 0.5rem 1.8rem; height: 45px; font-size: 1rem; border: 1px solid #ccc; border-radius: 6px;">
                <option value="" {{ empty($region) ? 'selected' : '' }}>All</option>
                <option value="North Goa" {{ $region === 'North Goa' ? 'selected' : '' }}>North Goa</option>
                <option value="South Goa" {{ $region === 'South Goa' ? 'selected' : '' }}>South Goa</option>
            </select>
            <button type="submit" style="background-color: rgba(6, 95, 70, 1); color: #fff; padding: 0.6rem 1.2rem; border: none; border-radius: 6px; cursor: pointer;">
            Apply Filter
            </button>
        </form>
    </div>

    {{-- VET CARD SECTION --}}
    <div style="background-color: rgba(6, 95, 70, 0.3); padding: 30px; border-radius: 12px; margin-bottom: 40px;" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @php
            $grouped = $vets->groupBy('region');
        @endphp

        @forelse ($grouped as $region => $group)
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mt-6 mb-4 border-b pb-2 border-gray-300 dark:border-gray-600">
                {{ $region }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach ($group as $vet)
                    <div style="background-color: rgba(6, 95, 70, 0.7);" class="shadow-md rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-semibold mb-2" style="color: #facc15;">{{ $vet->name }}</h3>
                        @if ($vet->veterinarian)
                            <p class="text-sm text-white mb-1"><span style="color: #facc15;">Veterinarian:</span> {{ $vet->veterinarian }}</p>
                        @endif
                        @if ($vet->phone)
                            <p class="text-sm text-white mb-1"><span style="color: #facc15;">Phone:</span> {{ $vet->phone }}</p>
                        @endif
                        @if ($vet->address)
                            <p class="text-sm text-white mb-1"><span style="color: #facc15;">Address:</span> {{ $vet->address }}</p>
                        @endif
                        @if ($vet->services)
                            <p class="text-sm text-white"><span style="color: #facc15;">Services:</span> {{ $vet->services }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @empty
            <p class="text-gray-700">No veterinarian data available for the selected region.</p>
        @endforelse
    </div>
</x-app-layout>
