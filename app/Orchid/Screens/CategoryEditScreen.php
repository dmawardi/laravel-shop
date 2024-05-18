<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CategoryEditScreen extends Screen
{
    /**
     * @var Category
     */
    public $category;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        return [
            'category' => $category,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->category->exists ? 'Edit category' : 'Creating a new category';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create category')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->category->exists),

            Button::make('Update category')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->category->exists),

            Button::make('Delete category')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->category->exists)
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('category.name')
                    ->title('Name')
                    ->placeholder($this->category->name ?? 'Category name')
                    ->help('Enter the name of the category'),

                TextArea::make('category.description')
                    ->title('Description')
                    ->placeholder($this->category->description ?? 'Category description')
                    ->help('Enter the description of the category')
            ])
        ];
    }

    /**
     * @param Category $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request) {
        $request->validate([
            'category.name' => 'required|string|max:255|unique:categories,name',
            'category.description' => 'nullable|string'
        ]);

        $this->category->fill([
            'name' => $request->input('category.name'),
            'description' => $request->input('category.description')
        ])->save();

        return redirect()->route('platform.categories.list');
    }

    /**
     * @param Category $category
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Category $category) {
        $this->category->delete();

        Alert::info('You have successfully deleted the category.');

        return redirect()->route('platform.categories.list');
    }
}