<?php

namespace App\Orchid\Layouts;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {     
        return [
            TD::make('name', 'Name')
                ->render(function (Product $product) {
                    return Link::make($product->name)
                        ->route('platform.products.edit', $product->id);
                }),
            TD::make('description', 'Description')
                ->render(function (Product $product) {
                    return $product->description;
                }),
            TD::make('price', 'Price')
                ->render(function (Product $product) {
                    return $product->price;
                }),
            TD::make('sku', 'SKU')
                ->render(function (Product $product) {
                    return $product->sku;
                }),
            TD::make('category_id', 'Category')
                ->render(function (Product $product) {
                    return $product->category->name;
                }),
            TD::make('image_url', 'Image')
                ->render(function (Product $product) {
                    return "<img src='{$product->image_url}' width='100' />";
                }),
            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
