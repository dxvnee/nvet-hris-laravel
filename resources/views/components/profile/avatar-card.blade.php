{{-- Profile Avatar Card Component --}}
@props(['user', 'formId' => 'profile-form'])

<div class="flex flex-col items-center lg:items-start">
    <div class="relative">
        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-primary shadow-lg">
            @if ($user->avatar && Storage::disk('public')->exists($user->avatar))
                <img id="profile-preview" src="{{ asset('storage/' . $user->avatar) }}" alt="Profile Photo"
                    class="w-full h-full object-cover">
            @else
                <img id="profile-preview"
                    src="{{ 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF&size=128' }}"
                    alt="Profile Photo" class="w-full h-full object-cover">
            @endif
        </div>
        <input type="file" id="avatar-file-input" name="avatar" accept="image/*" class="hidden"
            form="{{ $formId }}" onchange="handleFileSelection(this)">
        <button type="button" onclick="document.getElementById('avatar-file-input').click()"
            class="absolute bottom-0 right-0 bg-primary hover:bg-primaryDark text-white p-3 rounded-full shadow-lg hover:shadow-xl transform hover:scale-110 transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>
        </button>
    </div>
</div>
