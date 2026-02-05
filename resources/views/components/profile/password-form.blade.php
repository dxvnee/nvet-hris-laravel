{{-- Profile Password Form Component --}}
@props(['action'])

<form action="{{ $action }}" method="POST" class="space-y-6" x-data="{
    showCurrent: false,
    showNew: false,
    showConfirm: false
}">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Current Password --}}
        <div class="space-y-2">
            <label for="current_password" class="block text-sm font-medium text-gray-700">
                Password Saat Ini <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input :type="showCurrent ? 'text' : 'password'" name="current_password" id="current_password" required
                    class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                <button type="button" @click="showCurrent = !showCurrent"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                    <x-icons.eye x-show="!showCurrent" class="w-5 h-5" />
                    <x-icons.eye-slash x-show="showCurrent" class="w-5 h-5" />
                </button>
            </div>
            @error('current_password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div></div>

        {{-- New Password --}}
        <div class="space-y-2">
            <label for="password" class="block text-sm font-medium text-gray-700">
                Password Baru <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input :type="showNew ? 'text' : 'password'" name="password" id="password" required
                    class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                <button type="button" @click="showNew = !showNew"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                    <x-icons.eye x-show="!showNew" class="w-5 h-5" />
                    <x-icons.eye-slash x-show="showNew" class="w-5 h-5" />
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="space-y-2">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Konfirmasi Password Baru <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" id="password_confirmation"
                    required
                    class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all">
                <button type="button" @click="showConfirm = !showConfirm"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                    <x-icons.eye x-show="!showConfirm" class="w-5 h-5" />
                    <x-icons.eye-slash x-show="showConfirm" class="w-5 h-5" />
                </button>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <x-ui.action-button type="submit" variant="danger" size="lg">
            Ganti Password
        </x-ui.action-button>
    </div>
</form>
