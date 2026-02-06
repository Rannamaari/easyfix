<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <h2 class="font-semibold text-xl text-gray-900 dark:text-white leading-tight">Request a Service</h2>
            <p class="text-sm text-gray-500 dark:text-slate-300">Tell us what you need and we’ll connect you with the right provider.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-slate-800">
                <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
                    @csrf
                    <input type="hidden" name="service_category_id" id="service_category_id" value="{{ old('service_category_id') }}">

                    {{-- Service Category --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-200">Service Category *</label>
                            <span class="text-xs text-gray-500 dark:text-slate-400">Tap an icon to select</span>
                        </div>
                        <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                            @foreach($categories as $category)
                                <button type="button"
                                    class="category-card border border-gray-200 dark:border-slate-700 rounded-xl p-4 text-left hover:border-blue-500 hover:bg-blue-50 dark:hover:border-blue-400 dark:hover:bg-slate-800 transition"
                                    data-category-id="{{ $category->id }}"
                                    data-services='@json($category->services)'
                                    data-category-name="{{ $category->name }}">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center dark:bg-blue-900/30 dark:text-blue-400">
                                            @if($category->icon)
                                                <x-dynamic-component :component="'heroicon-o-' . $category->icon" class="w-5 h-5" />
                                            @else
                                                <x-heroicon-o-wrench-screwdriver class="w-5 h-5" />
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $category->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-slate-400">Tap to select</p>
                                        </div>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                        @error('service_category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Service (optional) --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-200">Specific Service (optional)</label>
                            <span class="text-xs text-gray-500 dark:text-slate-400">Pick one or type your issue</span>
                        </div>
                        <div id="service-chips" class="mt-3 flex flex-wrap gap-2"></div>
                        <input type="hidden" name="service_id" id="service_id" value="{{ old('service_id') }}">
                        @error('service_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <div class="mt-3">
                            <label for="specific_issue" class="block text-sm font-medium text-gray-700 dark:text-slate-200">If not listed, describe your specific issue</label>
                            <input type="text" name="specific_issue" id="specific_issue" value="{{ old('specific_issue') }}"
                                placeholder="e.g., AC not cooling, tire puncture, sink leak"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('specific_issue')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Describe your issue *</label>
                        <textarea name="description" id="description" rows="4" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Please describe the problem in detail...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="space-y-4">
                        <div>
                            <p class="block text-sm font-medium text-gray-700 dark:text-slate-200">Service Address *</p>
                            <div class="mt-2 flex flex-wrap gap-4">
                                @php
                                    $addressMode = old('address_mode', $addresses->isNotEmpty() ? 'saved' : 'new');
                                    $defaultAddressId = $addresses->firstWhere('is_default', true)?->id ?? $addresses->first()?->id;
                                @endphp
                                <label class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-slate-200">
                                    <input type="radio" name="address_mode" value="saved" {{ $addressMode === 'saved' ? 'checked' : '' }} {{ $addresses->isEmpty() ? 'disabled' : '' }} required>
                                    Use saved address
                                </label>
                                <label class="inline-flex items-center gap-2 text-sm text-gray-700 dark:text-slate-200">
                                    <input type="radio" name="address_mode" value="new" {{ $addressMode === 'new' ? 'checked' : '' }} required>
                                    Add a new address
                                </label>
                            </div>
                            @error('address_mode')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="saved-address-fields" class="{{ $addressMode === 'saved' ? '' : 'hidden' }}">
                            <label for="address_id" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Select Address</label>
                            <select name="address_id" id="address_id"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Choose an address</option>
                                @foreach($addresses as $address)
                                    @php
                                        $selectedAddressId = old('address_id') ?? $defaultAddressId;
                                    @endphp
                                    <option value="{{ $address->id }}" {{ (string) $selectedAddressId === (string) $address->id ? 'selected' : '' }}>
                                        {{ ucfirst($address->label) }} - {{ $address->address }}
                                    </option>
                                @endforeach
                            </select>
                            @error('address_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="new-address-fields" class="{{ $addressMode === 'new' ? '' : 'hidden' }} space-y-4">
                            <div>
                                <label for="new_address_label" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Address Type</label>
                                <select name="new_address_label" id="new_address_label"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select type</option>
                                    <option value="home" {{ old('new_address_label') === 'home' ? 'selected' : '' }}>Home</option>
                                    <option value="work" {{ old('new_address_label') === 'work' ? 'selected' : '' }}>Work</option>
                                    <option value="other" {{ old('new_address_label') === 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('new_address_label')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="new_address" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Full Address</label>
                                <textarea name="new_address" id="new_address" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Street, city, state, zip">{{ old('new_address') }}</textarea>
                                @error('new_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Preferred Time --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-200">Preferred Date & Time</label>
                        <div class="mt-2 grid gap-3 sm:grid-cols-2">
                            <div>
                                <input type="date" name="preferred_date" id="preferred_date" value="{{ old('preferred_date') }}"
                                    class="block w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <select name="preferred_time_slot" id="preferred_time_slot"
                                    class="block w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Select a time</option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                    <option value="17:00">05:00 PM</option>
                                    <option value="19:00">07:00 PM</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="preferred_time" id="preferred_time" value="{{ old('preferred_time') }}">
                        @error('preferred_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('preferred_time_slot')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('preferred_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500 dark:text-slate-400">Only future dates can be selected.</p>
                    </div>

                    {{-- Attachments --}}
                    <div>
                        <label for="attachments" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Photos (optional, max 5)</label>
                        <input type="file" name="attachments[]" id="attachments" multiple accept="image/*,.pdf"
                            class="mt-1 block w-full text-sm text-gray-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-500/10 dark:file:text-blue-200">
                        <p class="mt-1 text-xs text-gray-500 dark:text-slate-400">Upload photos of the issue (JPG, PNG, PDF - max 5MB each)</p>
                        @error('attachments.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('jobs.index') }}" class="px-4 py-2 border border-gray-300 dark:border-slate-700 rounded-md text-gray-700 dark:text-slate-200 hover:bg-gray-50 dark:hover:bg-slate-800">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const addressModeRadios = document.querySelectorAll('input[name="address_mode"]');
        const savedAddressFields = document.getElementById('saved-address-fields');
        const newAddressFields = document.getElementById('new-address-fields');

        function toggleAddressFields() {
            const selected = document.querySelector('input[name="address_mode"]:checked')?.value;
            const addressId = document.getElementById('address_id');
            const newAddressLabel = document.getElementById('new_address_label');
            const newAddress = document.getElementById('new_address');

            if (selected === 'saved') {
                savedAddressFields.classList.remove('hidden');
                newAddressFields.classList.add('hidden');
                if (addressId) {
                    addressId.required = true;
                    addressId.disabled = false;
                }
                if (newAddressLabel) {
                    newAddressLabel.required = false;
                    newAddressLabel.disabled = true;
                }
                if (newAddress) {
                    newAddress.required = false;
                    newAddress.disabled = true;
                }
            } else {
                savedAddressFields.classList.add('hidden');
                newAddressFields.classList.remove('hidden');
                if (addressId) {
                    addressId.required = false;
                    addressId.disabled = true;
                }
                if (newAddressLabel) {
                    newAddressLabel.required = true;
                    newAddressLabel.disabled = false;
                }
                if (newAddress) {
                    newAddress.required = true;
                    newAddress.disabled = false;
                }
            }
        }

        addressModeRadios.forEach(radio => radio.addEventListener('change', toggleAddressFields));
        toggleAddressFields();

        const categoryInput = document.getElementById('service_category_id');
        const serviceIdInput = document.getElementById('service_id');
        const serviceChips = document.getElementById('service-chips');
        const categoryCards = document.querySelectorAll('.category-card');

        function renderServices(services) {
            serviceChips.innerHTML = '';
            if (!services.length) {
                const empty = document.createElement('p');
                empty.className = 'text-sm text-gray-500 dark:text-slate-400';
                empty.textContent = 'No specific services listed. Add your issue below.';
                serviceChips.appendChild(empty);
                return;
            }

            services.forEach(service => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'service-chip px-3 py-1.5 rounded-full border border-gray-200 dark:border-slate-700 text-sm text-gray-700 dark:text-slate-200 hover:border-blue-500 hover:text-blue-700 dark:hover:text-blue-300';
                btn.dataset.serviceId = service.id;
                btn.textContent = service.name;
                btn.addEventListener('click', () => {
                    serviceIdInput.value = service.id;
                    document.querySelectorAll('.service-chip').forEach(chip => {
                        chip.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                        chip.classList.remove('dark:bg-blue-500/20', 'dark:text-blue-200', 'dark:border-blue-400');
                    });
                    btn.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.add('dark:bg-blue-500/20', 'dark:text-blue-200', 'dark:border-blue-400');
                });
                serviceChips.appendChild(btn);
            });
        }

        categoryCards.forEach(card => {
            card.addEventListener('click', () => {
                categoryCards.forEach(c => c.classList.remove('border-blue-600', 'ring-2', 'ring-blue-200', 'dark:ring-blue-400/40'));
                card.classList.add('border-blue-600', 'ring-2', 'ring-blue-200');
                card.classList.add('dark:ring-blue-400/40');
                categoryInput.value = card.dataset.categoryId;
                const services = card.dataset.services ? JSON.parse(card.dataset.services) : [];
                renderServices(services);
            });
        });

        if (categoryInput.value) {
            const selectedCard = Array.from(categoryCards).find(card => card.dataset.categoryId === categoryInput.value);
            if (selectedCard) {
                selectedCard.classList.add('border-blue-600', 'ring-2', 'ring-blue-200', 'dark:ring-blue-400/40');
                const services = selectedCard.dataset.services ? JSON.parse(selectedCard.dataset.services) : [];
                renderServices(services);
            }
        }

        const preferredDate = document.getElementById('preferred_date');
        const preferredTimeSlot = document.getElementById('preferred_time_slot');
        const preferredTimeHidden = document.getElementById('preferred_time');
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        preferredDate.min = `${yyyy}-${mm}-${dd}`;

        function updatePreferredTime() {
            if (preferredDate.value && preferredTimeSlot.value) {
                preferredTimeHidden.value = `${preferredDate.value}T${preferredTimeSlot.value}`;
            } else {
                preferredTimeHidden.value = '';
            }
        }

        preferredDate.addEventListener('change', updatePreferredTime);
        preferredTimeSlot.addEventListener('change', updatePreferredTime);
    </script>
</x-app-layout>
