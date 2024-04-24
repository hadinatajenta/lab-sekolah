@section('title', 'Reset Password')
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password kamu? Tidak masalah. Beritahu alamat email terdaftar kamu sehingga kami bisa mengirimkan link reset password baru agar kamu bisa mengatur ulang password.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="block mt-1 w-full my-2" type="email" name="email" :value="old('email')"
                required autofocus placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
