<?php

namespace App\Livewire\Admin\Workplaces;

use App\Models\WorkPlace;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Workplaces | Admin')]
class ListWorkplaces extends Component
{
    public $workPlaceName = "";

    public $editWorkPlace = null;


    public function save()
    {
        $this->validate([
            'workPlaceName' => 'required|unique:work_places,name' . ($this->editWorkPlace ? ',' . $this->editWorkPlace->id : ''),
        ]);

        WorkPlace::updateOrCreate(
            ['id' => $this->editWorkPlace?->id],
            ['name' => $this->workPlaceName]
        );

        $this->reset(['workPlaceName', 'editWorkPlace']);

        if($this->editWorkPlace){
            Toaster::success("Workplace updated successfully");
        } else {
            Toaster::success("Workplace added successfully");
        }
    }

    public function edit(WorkPlace $workPlace)
    {
        $this->editWorkPlace = $workPlace;
        $this->workPlaceName = $workPlace->name;
    }

    public function delete(WorkPlace $workPlace)
    {
        if($workPlace->candidateJobs()->count() > 0) {
            Toaster::error("This item already attached to existing jobs!");
            return;
        }

        $workPlace->delete();

        Toaster::success('Workplace deleted successfully.');
    }


    public function render()
    {
        return view('livewire.admin.workplaces.list-workplaces', [
            'workplaces' => WorkPlace::all()
        ]);
    }
}
