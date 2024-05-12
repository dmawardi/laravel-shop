<?php

namespace App\Orchid\Screens;

use App\Models\Category;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use App\Models\Product;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
    /**
     * @var Product
     */
    public $product;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {
        return [
            'product' => $product,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->product->exists ? 'Edit product' : 'Creating a new product';
    }
    public function description(): ?string
    {
        return "Create a brand new product in the database";
    }
    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create product')
            ->icon('pencil')
            ->method('createOrUpdate')
            ->canSee(!$this->product->exists),

        Button::make('Update')
            ->icon('note')
            ->method('createOrUpdate')
            ->canSee($this->product->exists),

        Button::make('Remove')
            ->icon('trash')
            ->method('remove')
            ->canSee($this->product->exists),
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
            // Form fields
            Layout::rows([
                Input::make('product.name')
                    ->title('Name')
                    ->placeholder('Attractive name for the product')
                    ->help('Specify the name of the product'),

                TextArea::make('product.description')
                    ->title('Description')
                    ->placeholder('Description of the product')
                    ->help('Specify the description of the product'),

                Input::make('product.price')
                    ->title('Price')
                    ->placeholder('Price of the product')
                    ->help('Specify the price of the product'),

                Input::make('product.sku')
                    ->title('SKU')
                    ->placeholder('SKU of the product')
                    ->help('Specify the SKU of the product'),

                Select::make('product.category_id')
                    ->fromModel(Category::class, 'name', 'id')
                    ->title('Category')
                    ->help('Specify the category of the product'),

                Input::make('product.image_url')
                    ->title('Image URL')
                    ->placeholder('Image URL of the product')
                    ->help('Specify the image URL of the product'),
            ]),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request)
    {
        // Validate the request
        $request->validate([
            'product.name' => 'required|max:255',
            'product.description' => 'required|max:255',
            'product.price' => 'required|numeric',
            'product.sku' => 'required',
            'product.category_id' => 'required|numeric',
            'product.image_url' => 'required|url',
        ]);

        // Fill the product with the request data
        $this->product->fill([
            'name' => $request->get('product.name'),
            'description' => $request->get('product.description'),
            'price' => $request->get('product.price'),
            'sku' => $request->get('product.sku'),
            'category_id' => $request->get('product.category_id'),
            'image_url' => $request->get('product.image_url'),
        ])->save();

        Alert::info('You have successfully created a product.');

        return redirect()->route('platform.products.list');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->product->delete();

        Alert::info('You have successfully deleted the product.');

        return redirect()->route('platform.products.list');
    }
}
