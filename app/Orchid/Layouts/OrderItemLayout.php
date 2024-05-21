<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderItemLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'order.items';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('product_name', 'Product Name')
            ->render(function ($item) {
                return $item->product->name;
            }),
            TD::make('product_price', 'Product Price')
            ->render(function ($item) {
                return $item->product->price;
            }),

            TD::make('quantity', 'Quantity')
                ->render(function ($item) {
                    return $item->quantity;
                }),
            TD::make('subtotal', 'Subtotal')
            ->render(function ($item) {
                return $item->subtotal;
            }),
        ];
    }
}
