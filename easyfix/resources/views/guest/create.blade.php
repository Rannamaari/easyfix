<x-public-layout>
    <x-slot name="title">Request a Service - {{ config('app.name') }}</x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="mb-6 rounded-lg border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-blue-900">
                You’re submitting this request as a <strong>guest</strong>. No account required.
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Request a Service</h1>
            <p class="text-gray-600 mb-6">No account needed. We'll contact you with a quote.</p>

            <form action="{{ route('guest.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Contact Info --}}
                <div class="border-b pb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Your Contact Info</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="guest_name" class="block text-sm font-medium text-gray-700">Your Name *</label>
                            <input type="text" name="guest_name" id="guest_name" required value="{{ old('guest_name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="John Doe">
                            @error('guest_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                                <input type="checkbox" id="guest_username_toggle" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                Create a username (optional)
                            </label>
                            <div id="guest_username_wrapper" class="mt-3 hidden">
                                <input type="text" name="guest_username" id="guest_username" value="{{ old('guest_username') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="e.g., ahmed1987">
                                @error('guest_username')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Use this if you plan to create an account later.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="guest_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="tel" name="guest_phone" id="guest_phone" value="{{ old('guest_phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="+1 (555) 123-4567">
                                @error('guest_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="guest_email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="guest_email" id="guest_email" value="{{ old('guest_email') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="john@example.com">
                                @error('guest_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <p class="text-xs text-gray-500">* Provide at least a phone number or email so we can reach you.</p>

                        <div>
                            <label for="guest_contact_preference" class="block text-sm font-medium text-gray-700">Preferred Contact Method</label>
                            <select name="guest_contact_preference" id="guest_contact_preference"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">No preference</option>
                                <option value="phone" {{ old('guest_contact_preference') === 'phone' ? 'selected' : '' }}>Phone Call</option>
                                <option value="email" {{ old('guest_contact_preference') === 'email' ? 'selected' : '' }}>Email</option>
                                <option value="whatsapp" {{ old('guest_contact_preference') === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Service Details --}}
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">Service Details</h2>

                    <div>
                        <label for="service_category_id" class="block text-sm font-medium text-gray-700">What do you need help with? *</label>
                        <select name="service_category_id" id="service_category_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-services='@json($category->services)' {{ old('service_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="service_id" class="block text-sm font-medium text-gray-700">Specific Service (optional)</label>
                        <select name="service_id" id="service_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select a service</option>
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Describe your issue *</label>
                        <textarea name="description" id="description" rows="4" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Please describe the problem in detail...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
                        <input type="text" name="address" id="address" required value="{{ old('address') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Street address">
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Preferred Date & Time</label>
                        <div class="mt-2 grid gap-3 sm:grid-cols-2">
                            <div>
                                <input type="date" name="preferred_date" id="preferred_date" value="{{ old('preferred_date') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <select name="preferred_time_slot" id="preferred_time_slot"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
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
                        <p class="mt-2 text-xs text-gray-500">Only future dates can be selected.</p>
                    </div>

                </div>

                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium">
                    Submit Request
                </button>

                <p class="text-center text-sm text-gray-500">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
                    to track all your jobs.
                </p>
            </form>
        </div>
    </div>

    <script>
        const guestUsernameToggle = document.getElementById('guest_username_toggle');
        const guestUsernameWrapper = document.getElementById('guest_username_wrapper');
        const guestUsernameInput = document.getElementById('guest_username');

        function toggleGuestUsername(forceOn = null) {
            const shouldShow = forceOn !== null ? forceOn : guestUsernameToggle.checked;
            guestUsernameWrapper.classList.toggle('hidden', !shouldShow);
            guestUsernameInput.disabled = !shouldShow;
        }

        if (guestUsernameInput.value) {
            guestUsernameToggle.checked = true;
        }

        toggleGuestUsername(guestUsernameToggle.checked);
        guestUsernameToggle.addEventListener('change', () => toggleGuestUsername());

        document.getElementById('service_category_id').addEventListener('change', function() {
            const serviceSelect = document.getElementById('service_id');
            const selectedOption = this.options[this.selectedIndex];
            const services = selectedOption.dataset.services ? JSON.parse(selectedOption.dataset.services) : [];

            serviceSelect.innerHTML = '<option value="">Select a service</option>';
            services.forEach(service => {
                const option = document.createElement('option');
                option.value = service.id;
                option.textContent = service.name;
                serviceSelect.appendChild(option);
            });
        });

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
</x-public-layout>
