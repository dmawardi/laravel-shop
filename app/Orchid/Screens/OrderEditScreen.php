<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use App\Models\ShippingInformation;
use App\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class OrderEditScreen extends Screen
{
    public $order;

    /**
     * Query data.
     *
     * @param Order $order
     * @return array
     */
    public function query(Order $order): array
    {
        return [
            'order' => $order
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'OrderEditScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Create')
            ->icon('pencil')
            ->method('createOrUpdate')
            ->canSee(!$this->order->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->order->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->order->exists),
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
                // Order fields
                Select::make('order.status')
                    ->title('Order Status')
                    ->options([
                        'paid' => 'Paid',
                        'unpaid' => 'Unpaid',
                        'pending' => 'Pending',
                        'refunded' => 'Refunded',
                        'cancelled' => 'Cancelled',
                    ])
                    ->help('Select the payment status of the order'),
                Input::make('order.total')
                    ->title('Total')
                    ->placeholder('Total')
                    ->help('Enter the total amount of the order'),
                Input::make('order.subtotal')
                    ->title('Subtotal')
                    ->placeholder('Subtotal')
                    ->help('Enter the subtotal amount of the order'),
                Input::make('order.tax')
                    ->title('Tax')
                    ->placeholder('Tax')
                    ->help('Enter the tax amount of the order'),
                Input::make('order.shipping_fee')
                    ->title('Shipping Fee')
                    ->placeholder('Shipping Fee')
                    ->help('Enter the shipping fee of the order'),
                Input::make('order.discount')
                    ->title('Discount')
                    ->placeholder('Discount')
                    ->help('Enter the discount amount of the order'),

                // Shipping information fields
                Input::make('order.address_line1')
                    ->title('Address Line 1')
                    ->placeholder('Address Line 1')
                    ->help('Enter the first line of the address'),
                Input::make('order.address_line2')
                    ->title('Address Line 2')
                    ->placeholder('Address Line 2')
                    ->help('Enter the second line of the address'),
                Input::make('order.city')
                    ->title('City')
                    ->placeholder('City')
                    ->help('Enter the city of the address'),
                Select::make('order.state')
                    ->title('State')
                    ->options(ShippingInformation::$states)
                    ->help('Select the state of the address'),
                Input::make('order.country')
                    ->title('Country')
                    ->placeholder('Country')
                    ->help('Enter the country of the address'),
                Input::make('order.postal_code')
                    ->title('Postal Code')
                    ->placeholder('Postal Code')
                    ->help('Enter the postal code of the address'),
                // Payment method
                Select::make('order.payment_method')
                    ->title('Payment Method')
                    ->options([
                        'credit_card' => 'Credit Card',
                        'bank_transfer' => 'Bank Transfer',
                        'cash_on_delivery' => 'Cash on Delivery',
                    ])
                    ->help('Select the payment method of the order'),
                // Cart fields
               
                // User field
                Select::make('order.user_id')
                    ->title('Buyer')
                    ->fromModel(User::class, 'name', 'id')
            ]),
        ];
    }

    public function createOrUpdate()
    {
        // Implement createOrUpdate method
    }
}
