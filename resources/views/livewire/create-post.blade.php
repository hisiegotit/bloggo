
<div>
    <x-header title="Posts" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />
        </x-slot:actions>
    </x-header>
    <x-form wire:submit="save">
        <x-input label="Title:" wire:model="title" />
        @php
            $config = [
                'spellChecker' => true,
                'maxHeight' => '200px'
            ];
        @endphp
        <x-markdown wire:model="content" label="Content" :config="$config"/>

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
