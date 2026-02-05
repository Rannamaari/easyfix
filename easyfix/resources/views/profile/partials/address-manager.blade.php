<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Saved Addresses</h2>
        <p class="mt-1 text-sm text-gray-600">Choose a default address or add a new one.</p>
    </header>

    <div class="mt-6 space-y-4">
        @if($addresses->isEmpty())
            <p class="text-sm text-gray-600">No saved addresses yet.</p>
        @else
            <div class="space-y-3">
                @foreach($addresses as $address)
                    <div class="border border-gray-200 rounded-md p-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">
                                {{ ucfirst($address->label) }}
                                @if($address->is_default)
                                    <span class="ml-2 inline-flex items-center rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700">Default</span>
                                @endif
                            </p>
                            <p class="mt-1 text-sm text-gray-600">{{ $address->address }}</p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            @if(!$address->is_default)
                                <form method="POST" action="{{ route('profile.addresses.default', $address) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-3 py-1.5 text-sm border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50">
                                        Set Default
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('profile.addresses.destroy', $address) }}" onsubmit="return confirm('Remove this address?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-sm border border-red-600 text-red-600 rounded-md hover:bg-red-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <form method="POST" action="{{ route('profile.addresses.store') }}" class="mt-6 space-y-4">
        @csrf
        <div>
            <label for="label" class="block text-sm font-medium text-gray-700">Address Type</label>
            <select name="label" id="label" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Select type</option>
                <option value="home">Home</option>
                <option value="work">Work</option>
                <option value="other">Other</option>
            </select>
            @error('label')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Full Address</label>
            <textarea name="address" id="address" rows="3" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                placeholder="Street, city, state, zip">{{ old('address') }}</textarea>
            @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Add Address
            </button>
        </div>
    </form>
</section>
