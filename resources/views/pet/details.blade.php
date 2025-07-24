<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        {{-- Header Section --}}
        <div class="rounded-xl mb-6 p-6 shadow-lg" style="background-color: rgba(6, 95, 70, 0.75);">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-3xl font-bold text-white">Welcome, {{ Auth::user()->name }}</h2>
                <button onclick="openAddPetModal()" class="bg-yellow-400 hover:bg-yellow-500 text-green-900 font-semibold px-4 py-2 rounded shadow">
                    + Add Pet
                </button>
            </div>
            <p class="text-white text-lg">Here are your registered pets:</p>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mt-4 bg-green-100 border border-green-400 text-green-800 p-3 rounded">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mt-4 bg-red-100 border border-red-400 text-red-800 p-3 rounded">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Pet Cards Section --}}
        <div class="rounded-xl p-6 shadow-inner" style="background-color: rgba(6, 95, 70, 0.1);">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pets as $pet)
                    <div class="p-4 rounded-xl shadow text-white transition hover:shadow-xl" style="background-color: rgba(6, 95, 70, 0.4);">
                        <h3 class="text-xl font-semibold">🐾 {{ $pet->name }}</h3>
                        <p><strong><span style="color: #facc15;">Species:</span></strong> {{ $pet->type }}</p>
                        <p><strong><span style="color: #facc15;">Breed:</span></strong> {{ $pet->breed }}</p>
                        <p><strong><span style="color: #facc15;">Color:</span></strong> {{ $pet->color }}</p>
                        <p><strong><span style="color: #facc15;">DoB:</span></strong> <span id="dob-{{ $pet->pet_id }}">{{ $pet->dob }}</span></p>
                        <p><strong><span style="color: #facc15;">Age:</span></strong> <span id="age-{{ $pet->pet_id }}">Calculating...</span></p>
                        <p><strong><span style="color: #facc15;">Microchip Number:</span></strong> {{ $pet->microchip_number }}</p>

                        <div class="mt-4 flex justify-end space-x-2">
                            <button onclick="openEditModal('{{ $pet->pet_id }}')" class="bg-yellow-400 hover:bg-yellow-500 text-green-900 px-3 py-1 rounded">Edit</button>
                            <button onclick="openDeleteModal('{{ $pet->pet_id }}')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Add Pet Modal --}}
    <div id="addPetModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white p-6 rounded-xl shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Add Pet</h2>
            <form method="POST" action="{{ route('pets.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block font-medium text-gray-700 mb-1">Pet Name</label>
                    <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="type" class="block font-medium text-gray-700 mb-1">Species</label>
                    <input type="text" name="type" id="type" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="breed" class="block font-medium text-gray-700 mb-1">Breed</label>
                    <input type="text" name="breed" id="breed" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="color" class="block font-medium text-gray-700 mb-1">Color</label>
                    <input type="text" name="color" id="color" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="dob" class="block font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label for="microchip_number" class="block font-medium text-gray-700 mb-1">Microchip Number</label>
                    <input type="text" name="microchip_number" id="microchip_number" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAddPetModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Add Pet</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Include Edit/Delete Modals --}}
    @include('components.pet-modals', ['pets' => $pets])

    {{-- Scripts --}}
    <script>
        function openAddPetModal() {
            document.getElementById('addPetModal').classList.remove('hidden');
        }

        function closeAddPetModal() {
            document.getElementById('addPetModal').classList.add('hidden');
        }

        function openEditModal(id) {
            document.getElementById('editModal-' + id).classList.remove('hidden');
        }

        function closeEditModal(id) {
            document.getElementById('editModal-' + id).classList.add('hidden');
        }

        function openDeleteModal(id) {
            document.getElementById('deleteModal-' + id).classList.remove('hidden');
        }

        function closeDeleteModal(id) {
            document.getElementById('deleteModal-' + id).classList.add('hidden');
        }

        // Calculate Age
        document.addEventListener('DOMContentLoaded', () => {
            @foreach($pets as $pet)
                (function () {
                    const dobElem = document.getElementById("dob-{{ $pet->pet_id }}");
                    const ageElem = document.getElementById("age-{{ $pet->pet_id }}");

                    if (dobElem && ageElem) {
                        const dobParts = dobElem.textContent.trim().split("-");
                        if (dobParts.length === 3) {
                            const dob = new Date(dobParts[0], dobParts[1] - 1, dobParts[2]);
                            const today = new Date();

                            let years = today.getFullYear() - dob.getFullYear();
                            let months = today.getMonth() - dob.getMonth();
                            let days = today.getDate() - dob.getDate();

                            if (days < 0) {
                                months--;
                                days += new Date(today.getFullYear(), today.getMonth(), 0).getDate();
                            }

                            if (months < 0) {
                                years--;
                                months += 12;
                            }

                            ageElem.textContent = `${years} year${years !== 1 ? 's' : ''}, ${months} month${months !== 1 ? 's' : ''}, ${days} day${days !== 1 ? 's' : ''}`;
                        } else {
                            ageElem.textContent = "Invalid DOB";
                        }
                    }
                })();
            @endforeach
        });
    </script>
</x-app-layout>
