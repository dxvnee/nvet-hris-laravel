{{-- Profile Edit Form Component --}}
@props(['user', 'action', 'formId' => 'profile-form'])

<form id="{{ $formId }}" action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PATCH')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-ui.form-input type="text" name="name" label="Nama Lengkap" :value="$user->name" required variant="rounded" />
        <x-ui.form-input type="email" name="email" label="Email" :value="$user->email" required variant="rounded" />
    </div>

    <div class="flex justify-end">
        <x-ui.action-button type="submit" variant="primary" size="lg">
            Simpan Perubahan
        </x-ui.action-button>
    </div>
</form>
