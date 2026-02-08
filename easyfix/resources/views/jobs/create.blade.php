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
                                    class="block w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-950 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:[&::-webkit-calendar-picker-indicator]:invert">
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

                    {{-- Photos --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-200">Photos (optional)</label>
                        <p class="mt-1 text-xs text-gray-500 dark:text-slate-400">Up to 5 photos, max 10MB each.</p>
                        <input type="file" id="photo-picker" multiple accept="image/*" class="hidden">
                        <button type="button" id="add-photos-btn"
                            class="mt-2 inline-flex items-center gap-2 px-4 py-2 rounded-md border border-gray-300 dark:border-slate-600 text-sm font-medium text-gray-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700">
                            <x-heroicon-o-camera class="w-5 h-5" />
                            <span id="add-photos-label">Add Photos</span>
                        </button>
                        <div id="photo-preview-list" class="mt-3 space-y-3"></div>
                        <p id="photo-help" class="mt-2 text-xs text-gray-500 dark:text-slate-400 hidden"></p>
                        @error('photos.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('photos')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('captions.*')
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

        // Photo upload with preview and captions
        const photoPicker = document.getElementById('photo-picker');
        const addPhotosBtn = document.getElementById('add-photos-btn');
        const addPhotosLabel = document.getElementById('add-photos-label');
        const previewList = document.getElementById('photo-preview-list');
        const photoHelp = document.getElementById('photo-help');
        const maxPhotos = 5;
        const maxSize = 10 * 1024 * 1024;
        let selectedFiles = [];

        addPhotosBtn.addEventListener('click', () => photoPicker.click());

        photoPicker.addEventListener('change', () => {
            const newFiles = Array.from(photoPicker.files || []);
            if (!newFiles.length) return;

            for (const file of newFiles) {
                if (selectedFiles.length >= maxPhotos) {
                    showPhotoHelp(`Maximum ${maxPhotos} photos allowed.`, true);
                    break;
                }
                if (file.size > maxSize) {
                    showPhotoHelp(`${file.name} is larger than 10MB.`, true);
                    continue;
                }
                selectedFiles.push({ file, caption: '' });
            }

            photoPicker.value = '';
            renderPhotoPreviews();
        });

        function showPhotoHelp(msg, isError) {
            photoHelp.textContent = msg;
            photoHelp.classList.remove('hidden');
            if (isError) {
                photoHelp.classList.add('text-red-600', 'dark:text-red-400');
                photoHelp.classList.remove('text-gray-500', 'dark:text-slate-400');
            } else {
                photoHelp.classList.remove('text-red-600', 'dark:text-red-400');
                photoHelp.classList.add('text-gray-500', 'dark:text-slate-400');
            }
        }

        function renderPhotoPreviews() {
            previewList.innerHTML = '';
            document.querySelectorAll('input[name="photos[]"], input[name="captions[]"]').forEach(el => el.remove());

            if (selectedFiles.length === 0) {
                photoHelp.classList.add('hidden');
                addPhotosLabel.textContent = 'Add Photos';
                return;
            }

            addPhotosLabel.textContent = selectedFiles.length >= maxPhotos ? 'Max reached' : 'Add More';
            if (selectedFiles.length >= maxPhotos) addPhotosBtn.disabled = true;
            else addPhotosBtn.disabled = false;

            selectedFiles.forEach((item, index) => {
                const row = document.createElement('div');
                row.className = 'flex items-start gap-3 p-3 rounded-lg border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50';

                const thumbUrl = URL.createObjectURL(item.file);
                row.innerHTML = `
                    <img src="${thumbUrl}" class="w-16 h-16 rounded-lg object-cover flex-shrink-0" alt="Preview">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">${item.file.name}</p>
                        <p class="text-xs text-gray-500 dark:text-slate-400">${(item.file.size / (1024 * 1024)).toFixed(1)} MB</p>
                        <input type="text" placeholder="Add a caption (optional)" value="${item.caption}"
                            class="mt-1.5 block w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            data-caption-index="${index}">
                    </div>
                    <button type="button" data-remove-index="${index}"
                        class="flex-shrink-0 p-1 text-gray-400 hover:text-red-500 dark:text-slate-500 dark:hover:text-red-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                `;

                row.querySelector(`[data-caption-index="${index}"]`).addEventListener('input', (e) => {
                    selectedFiles[index].caption = e.target.value;
                });

                row.querySelector(`[data-remove-index="${index}"]`).addEventListener('click', () => {
                    selectedFiles.splice(index, 1);
                    renderPhotoPreviews();
                });

                previewList.appendChild(row);
            });

            const dt = new DataTransfer();
            selectedFiles.forEach(item => dt.items.add(item.file));
            const hiddenFileInput = document.createElement('input');
            hiddenFileInput.type = 'file';
            hiddenFileInput.name = 'photos[]';
            hiddenFileInput.multiple = true;
            hiddenFileInput.files = dt.files;
            hiddenFileInput.className = 'hidden';
            previewList.appendChild(hiddenFileInput);

            selectedFiles.forEach((item, index) => {
                const captionInput = document.createElement('input');
                captionInput.type = 'hidden';
                captionInput.name = 'captions[]';
                captionInput.value = item.caption;
                captionInput.dataset.captionSync = index;
                previewList.appendChild(captionInput);
            });

            const totalMb = selectedFiles.reduce((sum, item) => sum + item.file.size, 0) / (1024 * 1024);
            showPhotoHelp(`${selectedFiles.length} photo(s) • ${totalMb.toFixed(1)} MB total`, false);
        }

        previewList.addEventListener('input', (e) => {
            if (e.target.dataset.captionIndex !== undefined) {
                const idx = parseInt(e.target.dataset.captionIndex);
                const syncInput = previewList.querySelector(`[data-caption-sync="${idx}"]`);
                if (syncInput) syncInput.value = e.target.value;
            }
        });
    </script>
</x-app-layout>
