<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="card hover:shadow-lg w-full rounded-xl md:shadow-md flex text-gray-900 bg-slate-100">
            <x-profile-avatar />
            <div class="py-3 px-6 flex flex-col justify-items-center h-full">
                <p class="mb-3 text-2xl font-semibold">
                    {{ Auth::user()->name }}
                </p>
                <p class="font-normal text-sm mb-1"><strong>
                    @if (Auth::user()->role == 1)
                        Administrator
                    @else
                        {{ Auth::user()->role_name }}</strong> / Faculty: {{ Auth::user()->faculty_name }}
                    @endif
                </p>
                <p class="font-normal text-sm mb-1">
                    {{ Auth::user()->username }}
                </p>
                <p class="font-normal text-sm mb-1">
                    {{ Auth::user()->email }}
                </p>
            </div>
        </div>

        <div class="mt-6">
            <x-input-label for="avatar" :value="__('Change your avatar')" />
            {{-- <input 
                class="mt-1 block w-full border-gray-300 focus:ring-primary-500 focus:border-primary-500 rounded-md shadow-sm" 
                type="file" name="avatar" id="avatar"
            > --}}
            <input class="mt-1 block w-full font-normal text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                id="avatar" name="avatar" type="file">
        </div>

        <div class="mt-2">
            <x-input-label for="name" :value="__('Change your name')" />
            <x-text-input id="name" name="name" type="text" class="font-normal mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="hidden">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" readonly class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-6 flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
