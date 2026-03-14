<div x-data="{
    value: @entangle($attributes->wire('model')),
    isFocused() { return document.activeElement !== this.$refs.trix },
    setValue() {
        if (this.$refs.trix && this.$refs.trix.editor) {
            this.$refs.trix.editor.loadHTML(this.value);
        }
    }}"
     x-init="setValue();
        $watch('value', () => isFocused() && setValue())"
     x-on:trix-initialize="setValue()"
     x-on:trix-change="value = $event.target.value"
     x-on:trix-focus="setValue()"
     {{ $attributes->whereDoesntStartWith('wire:model') }}
     wire:ignore {{ $attributes->merge(['class' => 'mt-1 rounded-md']) }}>

    <input id="x" type="hidden">

    <trix-editor x-ref="trix" input="x" class=""></trix-editor>
</div>
