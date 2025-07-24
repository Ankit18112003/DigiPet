<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Vaccination Records</h2>
            <button onclick="openModal('addVaccinationModal')" class="bg-emerald-700 text-white px-4 py-2 rounded hover:bg-emerald-800">
                Add Vaccination
            </button>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Filter by Pet:</label>
            <select id="petFilter" class="w-full border rounded px-3 py-2" onchange="filterVaccinations()">
                <option value="all">All Pets</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->pet_id }}">{{ $pet->name }}</option>
                @endforeach
            </select>
        </div>

        @foreach($pets as $pet)
            @php
                $pendingBoosters = $pet->vaccinations->sum(fn($v) => $v->boosterDose->where('status', 'Pending')->count());
            @endphp

            <div class="pet-vaccination-group" data-pet-id="{{ $pet->pet_id }}">
                <div class="flex justify-between items-center mt-8 mb-2">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $pet->name }}'s Vaccinations</h3>
                    <span class="bg-yellow-300 text-gray-800 text-sm px-3 py-1 rounded-full shadow">
                        {{ $pendingBoosters }} booster{{ $pendingBoosters !== 1 ? 's' : '' }} pending
                    </span>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    @forelse($pet->vaccinations as $vaccination)
                        @php
                            $boosterDoses = $vaccination->boosterDose ?? collect();
                            $givenCount = $boosterDoses->where('status', 'Given')->count();
                            $remaining = $vaccination->total_booster_doses - $givenCount;
                            $nextDueBooster = $boosterDoses->where('status', 'Pending')->sortBy('ideal_date')->first();
                            $isOverdue = $nextDueBooster && \Carbon\Carbon::parse($nextDueBooster->ideal_date)->isPast();
                        @endphp

                        <div class="bg-white shadow rounded-lg p-5 relative overflow-hidden border border-gray-200">
                            <p><strong>Vaccine:</strong> {{ $vaccination->vaccine->vaccine_name ?? 'N/A' }}</p>
                            <p><strong>Date Administered:</strong> {{ $vaccination->date_administered }}</p>
                            <p><strong>Administered By / Notes:</strong> {{ $vaccination->notes ?? 'N/A' }}</p>

                            <p class="mt-3">
                                <strong>Booster Status:</strong>
                                @if ($remaining > 0)
                                    <span class="{{ $isOverdue ? 'text-red-600 font-semibold animate-pulse' : 'text-gray-800' }}">
                                        Active — {{ $givenCount }}/{{ $vaccination->total_booster_doses }} given
                                        @if ($nextDueBooster)
                                            <br>
                                            {{ $isOverdue ? '⚠️ Overdue! Was due on ' : 'Upcoming booster due on ' }}
                                            <strong>{{ \Carbon\Carbon::parse($nextDueBooster->ideal_date)->format('d M Y') }}</strong>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-green-700 font-semibold">Done — All boosters completed</span>
                                @endif
                            </p>

                            <!-- Original Progress bar (unstyled, as requested) -->
                            <div class="mt-3 h-2 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-600 transition-all duration-500" style="width: {{ $vaccination->total_booster_doses > 0 ? ($givenCount / $vaccination->total_booster_doses) * 100 : 100 }}%;"></div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-2 mt-4">
                                <button onclick="openModal('editModal-{{ $vaccination->id }}')" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Edit</button>
                                <button onclick="openModal('deleteModal-{{ $vaccination->id }}')" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</button>

                                @if ($remaining > 0)
                                    <button onclick="openModal('updateBoosterModal-{{ $vaccination->id }}')" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Record Booster</button>
                                    <button onclick="toggleTimeline('timeline-{{ $vaccination->id }}')" class="bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-800">Toggle Timeline</button>
                                @endif
                            </div>

                            <!-- Booster Timeline with Ideal + Given Dates -->
                            @if ($boosterDoses->isNotEmpty())
                                <div id="timeline-{{ $vaccination->id }}" class="mt-4 hidden text-sm">
                                    <ul class="space-y-2">
                                        @foreach($boosterDoses->sortBy('ideal_date') as $booster)
                                            @php
                                                $isOverdue = \Carbon\Carbon::parse($booster->ideal_date)->isPast() && $booster->status !== 'Given';
                                            @endphp
                                            <li class="flex items-center justify-between p-3 rounded
                                                {{ $booster->status === 'Given' ? 'bg-green-100' : ($isOverdue ? 'bg-red-100 animate-pulse' : 'bg-yellow-100') }}">
                                                <div>
                                                    <p><strong>Booster {{ $booster->dose_number }}</strong></p>
                                                    <p>
                                                        Ideal: {{ \Carbon\Carbon::parse($booster->ideal_date)->format('d M Y') }}<br>
                                                        Given: {{ $booster->given_date ? \Carbon\Carbon::parse($booster->given_date)->format('d M Y') : 'Not yet given' }}
                                                    </p>
                                                </div>
                                                <span class="font-medium text-right">{{ $booster->status }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 mt-4">No vaccinations recorded for {{ $pet->name }}.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

    @include('components.vaccination_modals', ['pets' => $pets, 'vaccines' => $vaccines])

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function filterVaccinations() {
            const selectedPet = document.getElementById('petFilter').value;
            const groups = document.querySelectorAll('.pet-vaccination-group');

            groups.forEach(group => {
                const petId = group.getAttribute('data-pet-id');
                group.style.display = (selectedPet === 'all' || selectedPet === petId) ? 'block' : 'none';
            });
        }

        function toggleTimeline(id) {
            const el = document.getElementById(id);
            el.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
