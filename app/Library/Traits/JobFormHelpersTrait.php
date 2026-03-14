<?php

namespace App\Library\Traits;

trait JobFormHelpersTrait
{
    public function toggleSectionTitleEditable(int $index)
    {
        $this->form->description[$index]['title_editable'] = !$this->form->description[$index]['title_editable'];
    }

    public function removeSection(int $index)
    {
        $this->form->description = array_filter($this->form->description, fn($value, $key) => $key !== $index, ARRAY_FILTER_USE_BOTH);
        $this->form->description = array_values($this->form->description);
    }

    public function addDescriptionSection()
    {
        $this->form->description[] = [
            "title" => "",
            "content" => "",
            "title_editable" => false
        ];
    }
}
