<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class OrderListScreen extends Screen
{
   /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'orders' => Order::with('payment', 'shippingInformation')->paginate()
        ];
    }


    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Order List Screen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create Order')
                ->icon('plus')
                ->route('platform.orders.edit'),
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
            Layout::table('orders', [
                // Define columns
                TD::make('id', 'ID')
                    ->render(function (Order $order) {
                        return Link::make($order->id)
                            ->route('platform.orders.edit', $order);
                    }),
                TD::make('user_id', 'User')
                    ->render(function (Order $order) {
                        return $order->buyer->name;
                    }),
               TD::make('status', 'Status'),
                TD::make('total', 'Total'),
                TD::make('subtotal', 'Subtotal'),
                TD::make('tax', 'Tax'),
                TD::make('shipping_fee', 'Shipping Fee'),
                TD::make('payment_status', 'Payment Status'),
                TD::make('payment_method', 'Payment Method'),
                TD::make('transaction_id', 'Transaction ID'),
                TD::make('paid_at', 'Paid At'),
                TD::make('shipped_at', 'Shipped At'),
            ]),
        ];
    }
}
