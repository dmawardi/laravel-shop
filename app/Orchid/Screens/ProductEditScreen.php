<?php

namespace App\Orchid\Screens;

use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use App\Models\Product;

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
        return [];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request)
    {
        $request->validate([
            'inquiry.name' => 'required|max:255',
            'inquiry.email' => 'required|email',
            'inquiry.phone' => 'nullable',
            'inquiry.company_name' => 'nullable',
            'inquiry.website' => 'nullable',
            'inquiry.type' => 'required|in:general,quote,support,partnership',
            'inquiry.status' => 'required|in:unread,read,archived,',
            'inquiry.message' => 'required',
        ]);

        $this->product->fill($request->get('product'))->save();

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
