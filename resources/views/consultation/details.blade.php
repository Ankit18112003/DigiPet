<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consultation Page') }}
        </h2>
    </x-slot>

    <div class="py-10" x-data="consultationPage()">
        <div class="max-w-5xl mx-auto px-4">
            <div class="bg-white shadow-xl rounded-lg p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Book a Consultation</h1>

                {{-- Pet & Region Selection --}}
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="pet_id" class="block mb-1 font-medium">Select a Pet:</label>
                        <select x-model="selectedPet" @change="fetchVets" id="pet_id" class="w-full border-gray-300 rounded-md">
                            <option value="">-- Select Pet --</option>
                            @foreach ($pets as $pet)
                                <option value="{{ $pet->pet_id }}">{{ $pet->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="selectedPet">
                        <label for="region" class="block mb-1 font-medium">Select Region:</label>
                        <select x-model="selectedRegion" @change="fetchVets" id="region" class="w-full border-gray-300 rounded-md">
                            <option value="">-- Select Region --</option>
                            <option value="north">North Goa</option>
                            <option value="south">South Goa</option>
                        </select>
                    </div>
                </div>

                {{-- Vet List --}}
                <template x-if="vetList.length > 0">
                    <form method="POST" action="{{ route('consultation.store') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="pet_id" :value="selectedPet">
                        <input type="hidden" name="region" :value="selectedRegion">

                        <div class="grid md:grid-cols-2 gap-6">
                            <template x-for="vet in vetList" :key="vet.vet_id">
                                <label class="p-4 border rounded-md shadow hover:shadow-md transition duration-200 flex items-start space-x-3 cursor-pointer">
                                    <input type="radio" name="vet_id" :value="vet.vet_id" class="mt-1.5">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800" x-text="vet.name"></h3>
                                        <p class="text-sm text-gray-600"><strong>Veterinarian:</strong> <span x-text="vet.veterinarian"></span></p>
                                        <p class="text-sm text-gray-600"><strong>Phone:</strong> <span x-text="vet.phone"></span></p>
                                        <p class="text-sm text-gray-600"><strong>Address:</strong> <span x-text="vet.address"></span></p>
                                        <p class="text-sm text-gray-600"><strong>Services:</strong> <span x-text="vet.services"></span></p>
                                    </div>
                                </label>
                            </template>
                        </div>

                        <div>
                            <label for="consultation_date" class="block mb-1 font-medium">Consultation Date:</label>
                            <input type="date" id="consultation_date" name="consultation_date" class="w-full border-gray-300 rounded-md" required>
                        </div>

                        <div>
                            <label for="purpose" class="block mb-1 font-medium">Purpose:</label>
                            <input type="text" id="purpose" name="purpose" class="w-full border-gray-300 rounded-md" placeholder="Reason for consultation" required>
                        </div>

                        <div>
                            <label for="notes" class="block mb-1 font-medium">Notes:</label>
                            <textarea id="notes" name="notes" class="w-full border-gray-300 rounded-md" rows="4" placeholder="Additional notes (optional)"></textarea>
                        </div>

                        {{-- Errors --}}
                        @if ($errors->any())
                            <div class="text-red-600">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Success --}}
                        @if(session('success'))
                            <div class="p-4 bg-green-100 text-green-800 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md">
                            Book Consultation
                        </button>
                    </form>
                </template>

                <template x-if="selectedRegion && vetList.length === 0">
                    <p class="text-red-500 font-medium mt-4">No vets found in this region.</p>
                </template>
            </div>

            {{-- Consultation History --}}
            @if($consultations->count())
                <div class="mt-10 bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Consultation History</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600 border">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-2">Pet</th>
                                    <th class="px-4 py-2">Vet</th>
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2">Purpose</th>
                                    <th class="px-4 py-2">Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultations as $consultation)
                                    <tr class="border-t">
                                        <td class="px-4 py-2">{{ $consultation->pet->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $consultation->vet->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $consultation->consultation_date }}</td>
                                        <td class="px-4 py-2">{{ $consultation->purpose }}</td>
                                        <td class="px-4 py-2">{{ $consultation->notes }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="text-gray-500 mt-10 text-center">No consultation records found yet.</p>
            @endif
        </div>
    </div>

    {{-- Alpine.js Component --}}
    <script>
        function consultationPage() {
            return {
                selectedPet: '{{ request("pet_id") }}',
                selectedRegion: '{{ request("region") }}',
                vetList: @json($vets ?? []),
                async fetchVets() {
                    if (!this.selectedPet || !this.selectedRegion) {
                        this.vetList = []
                        return
                    }

                    const res = await fetch(`/get-vets-by-region?pet_id=${this.selectedPet}&region=${this.selectedRegion}`);
                    const data = await res.json();
                    this.vetList = data.vets;
                }
            }
        }
    </script>
</x-app-layout>
