{{-- Add Vaccination Modal --}}
<div id="addVaccinationModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6 relative">
        <h3 class="text-lg font-semibold mb-4">Add Vaccination</h3>
        <form action="{{ route('vaccination.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="pet_id" class="block font-semibold mb-1">Select Pet:</label>
                <select name="pet_id" required class="w-full border px-3 py-2 rounded">
                    @foreach($pets as $pet)
                        <option value="{{ $pet->pet_id }}">{{ $pet->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="vaccine_id" class="block font-semibold mb-1">Select Vaccine:</label>
                <select name="vaccine_id" id="vaccineSelect" required class="w-full border px-3 py-2 rounded text-black">
                    <option value="" disabled selected>Select a vaccine</option>
                    @foreach($vaccines as $vaccine)
                        <option value="{{ $vaccine->id }}"
                            data-gap="{{ $vaccine->booster_gap_days }}"
                            data-count="{{ $vaccine->booster_count }}">
                            {{ $vaccine->vaccine_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="date_administered" class="block font-semibold mb-1">Date Administered:</label>
                <input type="date" name="date_administered" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-4">
                <label for="notes" class="block font-semibold mb-1">Administered By / Notes:</label>
                <input type="text" name="notes" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-4 flex gap-4">
                <div class="flex-1">
                    <label for="booster_gap_days" class="block font-semibold mb-1">Booster Gap (days):</label>
                    <input type="number" name="booster_gap_days" id="booster_gap" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="flex-1">
                    <label for="total_booster_doses" class="block font-semibold mb-1">Number of Boosters:</label>
                    <input type="number" name="total_booster_doses" id="booster_count" class="w-full border px-3 py-2 rounded">
                </div>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('addVaccinationModal')" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700">Add</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit, Delete, and Booster Modals --}}
@foreach($pets as $pet)
    @foreach($pet->vaccinations as $vaccination)
        {{-- Edit Vaccination Modal --}}
        <div id="editModal-{{ $vaccination->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6 relative">
                <h3 class="text-lg font-semibold mb-4">Edit Vaccination</h3>
                <form action="{{ route('vaccination.update', $vaccination->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Pet:</label>
                        <input type="text" disabled value="{{ $pet->name }}" class="w-full border px-3 py-2 rounded bg-gray-100">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Vaccine:</label>
                        <select name="vaccine_id" class="w-full border px-3 py-2 rounded">
                            @foreach($vaccines->where('animal_type', $pet->type) as $vaccine)
                                <option value="{{ $vaccine->id }}" {{ $vaccination->vaccine_id == $vaccine->id ? 'selected' : '' }}>
                                    {{ $vaccine->vaccine_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Date Administered:</label>
                        <input type="date" name="date_administered" value="{{ $vaccination->date_administered }}" class="w-full border px-3 py-2 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Notes:</label>
                        <input type="text" name="notes" value="{{ $vaccination->notes }}" class="w-full border px-3 py-2 rounded">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal('editModal-{{ $vaccination->id }}')" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Delete Vaccination Modal --}}
        <div id="deleteModal-{{ $vaccination->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-red-600 mb-4">Are you sure you want to delete this vaccination?</h3>
                <form action="{{ route('vaccination.destroy', $vaccination->id) }}" method="POST" class="flex justify-end gap-2">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeModal('deleteModal-{{ $vaccination->id }}')" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
                </form>
            </div>
        </div>

        {{-- Record Booster Dose Modal --}}
        <div id="updateBoosterModal-{{ $vaccination->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Record Booster Dose</h3>
                <form action="{{ route('booster.mark', $vaccination->id) }}" method="POST" class="space-y-4">
                    @csrf

                    @php
                        $pending = $vaccination->boosterDose->where('status', 'Pending')->sortBy('ideal_date')->first();
                    @endphp

                    @if ($pending)
                        <input type="hidden" name="booster_id" value="{{ $pending->id }}">
                    @endif

                    <p class="text-gray-700">Pet: <strong>{{ $pet->name }}</strong></p>
                    <p class="text-gray-700">Vaccine: <strong>{{ $vaccination->vaccine->vaccine_name ?? 'N/A' }}</strong></p>

                    <div>
                        <label class="block font-semibold mb-1">Date Given:</label>
                        <input type="date" name="date_given" required class="w-full border px-3 py-2 rounded">
                    </div>

                    <input type="hidden" name="status" value="Given">

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal('updateBoosterModal-{{ $vaccination->id }}')" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Record</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endforeach

<script>
    document.getElementById('vaccineSelect')?.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('booster_gap').value = selectedOption.dataset.gap;
        document.getElementById('booster_count').value = selectedOption.dataset.count;
    });
</script>
