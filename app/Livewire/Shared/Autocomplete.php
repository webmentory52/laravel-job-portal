<?php

namespace App\Livewire\Shared;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class Autocomplete extends Component
{
    public string $label;

    public string $query = '';

    #[Reactive]
    public $list = [];

    public $selected = null;

    public function updatedQuery()
    {
        if(strlen($this->query) < 2) {
            $this->dispatch("clear-selection");
            return;
        }

        $this->dispatch("search", $this->query);
    }

    public function selectItem($id)
    {
        $this->selected = $id;

        $item = array_find($this->list, fn($item) => $item['id'] == $this->selected);

        $this->query = $item['name'];

        $this->dispatch("select-item", $item);
    }

    public function clearSelection()
    {
        $this->selected = null;

        $this->query = '';

        $this->dispatch("clear-selection");
    }

    public function render()
    {
        return view('livewire.shared.autocomplete');
    }
}
