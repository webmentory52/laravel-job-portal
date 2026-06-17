<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

#[Title('Categories | Admin')]
class ListCategories extends Component
{
    public $name;

    public $categoryId;

    public $isEditing = false;

    public function save()
    {
        $this->validate([
           'name' => 'required|min:3|unique:categories,name' . ($this->isEditing ? ',' . $this->categoryId : ''),
        ]);

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            ['name' => $this->name, 'slug' => Str::slug($this->name)]
        );

        $this->reset(['isEditing', 'categoryId', 'name']);

        Toaster::success('Category saved successfully.');
    }

    public function edit(Category $category)
    {
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->isEditing = true;
    }

    public function delete(Category $category)
    {
        $category->delete();

        Toaster::success('Category deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.categories.list-categories', [
            'categories' => Category::latest()->get(),
        ]);
    }
}
