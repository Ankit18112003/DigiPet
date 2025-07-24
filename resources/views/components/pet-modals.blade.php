@foreach($pets as $pet)
<!-- Edit Pet Modal -->
<div id="editModal-{{ $pet->pet_id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white p-6 rounded shadow-lg max-w-md w-full">
        <h2 class="text-xl font-bold mb-4">Edit Pet</h2>
        <form method="POST" action="{{ route('pets.update', ['pet' => $pet->pet_id]) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name-{{ $pet->pet_id }}" class="block font-semibold mb-1">Pet Name</label>
                <input type="text" name="name" id="name-{{ $pet->pet_id }}" value="{{ $pet->name }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="type-{{ $pet->pet_id }}" class="block font-semibold mb-1">Species</label>
                <input type="text" name="type" id="type-{{ $pet->pet_id }}" value="{{ $pet->type }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="breed-{{ $pet->pet_id }}" class="block font-semibold mb-1">Breed</label>
                <input type="text" name="breed" id="breed-{{ $pet->pet_id }}" value="{{ $pet->breed }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="color-{{ $pet->pet_id }}" class="block font-semibold mb-1">Color</label>
                <input type="text" name="color" id="color-{{ $pet->pet_id }}" value="{{ $pet->color }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="dob-{{ $pet->pet_id }}" class="block font-semibold mb-1">Date of Birth</label>
                <input type="date" name="dob" id="dob-{{ $pet->pet_id }}" value="{{ $pet->dob }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="microchip_number-{{ $pet->pet_id }}" class="block font-semibold mb-1">Microchip Number</label>
                <input type="text" name="microchip_number" id="microchip_number-{{ $pet->pet_id }}" value="{{ $pet->microchip_number }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('editModal-{{ $pet->pet_id }}').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Pet Modal -->
<div id="deleteModal-{{ $pet->pet_id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white p-6 rounded shadow-lg max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-center">Confirm Delete</h2>
        <p class="mb-6 text-center">Are you sure you want to delete <strong>{{ $pet->name }}</strong>?</p>

        <div class="flex justify-center space-x-4">
            <form method="POST" action="{{ route('pets.destroy', ['pet' => $pet->pet_id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Yes, Delete</button>
            </form>
            <button type="button" onclick="document.getElementById('deleteModal-{{ $pet->pet_id }}').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        </div>
    </div>
</div>
@endforeach
