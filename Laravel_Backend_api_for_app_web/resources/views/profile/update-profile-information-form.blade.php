<x-jet-form-section submit="updateProfileInformation" class="bg-gradient-to-r from-blue-100 to-purple-100 p-6 rounded-lg shadow-md"
>
    <x-slot name="title">
        <h2 class="text-xl font-semibold text-gray-800">{{ __('Profile Information') }}</h2>
    </x-slot>

    <x-slot name="description">
        <p class="text-gray-600">{{ __('Update your account\'s profile information and email address.') }}</p>
    </x-slot>

    
    <x-slot name="form" >
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" class="text-gray-700 font-medium" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-28 w-28 object-cover border-4 border-white shadow-sm">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-28 h-28 bg-cover bg-no-repeat bg-center border-4 border-white shadow-sm"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-4 mr-2 bg-white text-blue-600 border border-blue-600 hover:bg-blue-50" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2 bg-white text-red-600 border border-red-600 hover:bg-red-50" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2 text-red-500" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" class="text-gray-700 font-medium" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full bg-white border border-gray-300 focus:border-blue-400 focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2 text-red-500" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-medium" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full bg-white border border-gray-300 focus:border-blue-400 focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2 text-red-500" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-yellow-600">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-blue-600 hover:text-blue-800" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Bio Data -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="bio" value="{{ __('Bio Data') }}" class="text-gray-700 font-medium" />
            <textarea class="mt-1 block w-full bg-white border border-gray-300 focus:border-blue-400 focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" id="bio" wire:model.defer="state.bio_data" placeholder="Bio Data"></textarea>
            <x-jet-input-error for="bio" class="mt-2 text-red-500" />
        </div>

        <!-- Experience -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="experience" value="{{ __('Experience') }}" class="text-gray-700 font-medium" />
            <x-jet-input id="experience" type="number" min="0" max="60" class="mt-1 block w-full bg-white border border-gray-300 focus:border-blue-400 focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.experience" autocomplete="experience" />
            <x-jet-input-error for="experience" class="mt-2 text-red-500" />
        </div>

        <!-- Category -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="category" value="{{ __('Category') }}" class="text-gray-700 font-medium" />
            <x-jet-input id="category" type="text" class="mt-1 block w-full bg-white border border-gray-300 focus:border-blue-400 focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="state.category" autocomplete="category" />
            <x-jet-input-error for="category" class="mt-2 text-red-500" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3 text-green-600" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
