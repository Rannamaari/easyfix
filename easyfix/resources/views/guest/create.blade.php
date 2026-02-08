<x-public-layout>
    <x-slot name="title">Request a Service - {{ config('app.name') }}</x-slot>

    <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-slate-800">
        <div class="p-6">
            <div class="mb-6 rounded-lg border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-blue-900 dark:border-blue-800/60 dark:bg-blue-900/40 dark:text-white">
                You’re submitting this request as a <strong>guest</strong>. No account required.
            </div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Request a Service</h1>
            <p class="text-gray-600 dark:text-slate-300 mb-6">No account needed. We'll contact you with a quote.</p>

            <form action="{{ route('guest.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Contact Info --}}
                <div class="border-b pb-6 border-gray-200 dark:border-slate-800">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Your Contact Info</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="guest_name" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Your Name *</label>
                            <input type="text" name="guest_name" id="guest_name" required value="{{ old('guest_name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder:text-slate-400"
                                placeholder="John Doe">
                            @error('guest_name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="guest_phone" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Phone *</label>
                                <input type="tel" name="guest_phone" id="guest_phone" required value="{{ old('guest_phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder:text-slate-400"
                                    placeholder="+1 (555) 123-4567">
                                @error('guest_phone')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="guest_email" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Email *</label>
                                <input type="email" name="guest_email" id="guest_email" required value="{{ old('guest_email') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder:text-slate-400"
                                    placeholder="john@example.com">
                                @error('guest_email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="guest_contact_preference" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Preferred Contact Method</label>
                            <select name="guest_contact_preference" id="guest_contact_preference"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
                                <option value="">No preference</option>
                                <option value="phone" {{ old('guest_contact_preference') === 'phone' ? 'selected' : '' }}>Phone Call</option>
                                <option value="email" {{ old('guest_contact_preference') === 'email' ? 'selected' : '' }}>Email</option>
                                <option value="whatsapp" {{ old('guest_contact_preference') === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Service Details --}}
                <div class="space-y-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Service Details</h2>

                    {{-- Service Category (icon card grid) --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-200">What do you need help with? *</label>
                            <span class="text-xs text-gray-500 dark:text-slate-400">Tap an icon to select</span>
                        </div>
                        <input type="hidden" name="service_category_id" id="service_category_id" value="{{ old('service_category_id') }}">
                        <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 gap-3">
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
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Specific Service (chips) --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-gray-700 dark:text-slate-200">Specific Service (optional)</label>
                            <span class="text-xs text-gray-500 dark:text-slate-400">Pick one or type your issue</span>
                        </div>
                        <div id="service-chips" class="mt-3 flex flex-wrap gap-2"></div>
                        <input type="hidden" name="service_id" id="service_id" value="{{ old('service_id') }}">
                        @error('service_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        <div class="mt-3">
                            <label for="specific_issue" class="block text-sm font-medium text-gray-700 dark:text-slate-200">If not listed, describe your specific issue</label>
                            <input type="text" name="specific_issue" id="specific_issue" value="{{ old('specific_issue') }}"
                                placeholder="e.g., AC not cooling, tire puncture, sink leak"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('specific_issue')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Describe your issue *</label>
                        <textarea name="description" id="description" rows="4" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder:text-slate-400"
                            placeholder="Please describe the problem in detail...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-slate-200">Address *</label>
                        <input type="text" name="address" id="address" required value="{{ old('address') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder:text-slate-400"
                            placeholder="Street address">
                        @error('address')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 dark:text-slate-200">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:placeholder:text-slate-400">
                    </div>

                    {{-- Preferred Time --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-slate-200">Preferred Date & Time</label>
                        <div class="mt-2 grid gap-3 sm:grid-cols-2">
                            <div>
                                <input type="date" name="preferred_date" id="preferred_date" value="{{ old('preferred_date') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100 dark:[&::-webkit-calendar-picker-indicator]:invert">
                            </div>
                            <div>
                                <select name="preferred_time_slot" id="preferred_time_slot"
                                    class="block w-full rounded-md border-gray-300 shadow-sm bg-white text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-slate-700 dark:text-slate-100">
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
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        @error('photos')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        @error('captions.*')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                    Submit Request
                </button>

                <p class="text-center text-sm text-gray-500 dark:text-slate-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline dark:text-blue-400">Login</a>
                    to track all your jobs.
                </p>
            </form>
        </div>
    </div>

    <script>
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
            // Remove old hidden inputs
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

            // Sync files to hidden file inputs using DataTransfer
            const dt = new DataTransfer();
            selectedFiles.forEach(item => dt.items.add(item.file));
            const hiddenFileInput = document.createElement('input');
            hiddenFileInput.type = 'file';
            hiddenFileInput.name = 'photos[]';
            hiddenFileInput.multiple = true;
            hiddenFileInput.files = dt.files;
            hiddenFileInput.className = 'hidden';
            previewList.appendChild(hiddenFileInput);

            // Add caption hidden inputs
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

        // Keep hidden caption inputs in sync
        previewList.addEventListener('input', (e) => {
            if (e.target.dataset.captionIndex !== undefined) {
                const idx = parseInt(e.target.dataset.captionIndex);
                const syncInput = previewList.querySelector(`[data-caption-sync="${idx}"]`);
                if (syncInput) syncInput.value = e.target.value;
            }
        });
    </script>
</x-public-layout>
