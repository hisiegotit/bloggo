<div>
    <x-header title="Update #{{ $post->id }}" separator />
    <x-form wire:submit="save">
        <x-input label="Title" wire:model="title" />
        {{-- <x-textarea label="Content" wire:model="content" /> --}}
        <x-markdown wire:model="content" label="Content" />

        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>

    @session('success')
        <x-alert icon="o-exclamation-triangle" class="alert-success">
            {{ session('success') }}
        </x-alert>
    @endsession
</div>
