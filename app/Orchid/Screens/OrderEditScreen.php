<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ShippingInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Alert;

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
        $order->load(['buyer', 'payment', 'shippingInformation']);
        
        return [
            'order' => $order,
            'user' => $order->user,
            'payment' => $order->payment,
            'shippingInformation' => $order->shippingInformation,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->order->exists ? 'Edit Order' : 'Creating a new Order';
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
            Layout::view('cart._cart'), // Include the cart view

            Layout::rows([
                // User field
                Select::make('order.user_id')
                    ->title('Buyer')
                    ->fromModel(User::class, 'name', 'id')
                    ->value($this->order->user_id),

                // Order fields
                Select::make('order.status')
                    ->title('Order Status')
                    ->options([
                        'Pending' => 'Pending',
                        'Processing' => 'Processing',
                        'Shipped' => 'Shipped',
                        'Delivered' => 'Delivered',
                        'Cancelled' => 'Cancelled',
                        'Refunded' => 'Refunded',
                        'Completed' => 'Completed',
                    ])
                    ->help('Select the order status of the order')
                    ->value($this->order->status),

                // Financial Dates
                DateTimer::make('order.paid_at')
                    ->title('Paid At')
                    ->help('Please select the date and time of payment.')
                    ->format('Y-m-d H:i')
                    ->value($this->order->paid_at),

                DateTimer::make('order.shipped_at')
                    ->title('Shipped At')
                    ->help('Please select the date and time of shipping.')
                    ->format('Y-m-d H:i')
                    ->value($this->order->shipped_at),

                // Shipping information fields
                Input::make('order.shippingInformation.address_line1')
                    ->title('Address Line 1')
                    ->placeholder('Address Line 1')
                    ->help('Enter the first line of the address')
                    ->value($this->order->shippingInformation->address_line1),

                Input::make('order.shippingInformation.address_line2')
                    ->title('Address Line 2')
                    ->placeholder('Address Line 2')
                    ->help('Enter the second line of the address')
                    ->value($this->order->shippingInformation->address_line2),

                Input::make('order.shippingInformation.city')
                    ->title('City')
                    ->placeholder('City')
                    ->help('Enter the city of the address')
                    ->value($this->order->shippingInformation->city),

                Select::make('order.shippingInformation.state')
                    ->title('State')
                    ->options(\App\Models\ShippingInformation::$states)
                    ->help('Select the state of the address')
                    ->value($this->order->shippingInformation->state),

                Input::make('order.shippingInformation.country')
                    ->title('Country')
                    ->placeholder('Country')
                    ->help('Enter the country of the address')
                    ->value($this->order->shippingInformation->country),

                Input::make('order.shippingInformation.postal_code')
                    ->title('Postal Code')
                    ->placeholder('Postal Code')
                    ->help('Enter the postal code of the address')
                    ->value($this->order->shippingInformation->postal_code),

                // Payment method
                Select::make('order.payment_method')
                    ->title('Payment Method')
                    ->options([
                        'Credit Card' => 'Credit Card',
                        'Bank Transfer' => 'Bank Transfer',
                        'Cash on Delivery' => 'Cash on Delivery',
                        'PayPal' => 'PayPal',
                        'Stripe' => 'Stripe',
                    ])
                    ->help('Select the payment method of the order')
                    ->value($this->order->payment->payment_method),

                Select::make('order.payment.status')
                    ->title('Payment Status')
                    ->options([
                        'Paid' => 'Paid',
                        'Unpaid' => 'Unpaid',
                        'Refunded' => 'Refunded',
                        'Cancelled' => 'Cancelled',
                        'Pending' => 'Pending',
                    ])
                    ->help('Select the payment status of the order')
                    ->value($this->order->payment->status),
            ]),
        ];
    }

    public function createOrUpdate(Order $order, Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'order.shippingInformation.address_line1' => 'required|string|max:255|min:5',
            'order.shippingInformation.address_line2' => 'nullable|string|max:255',
            'order.shippingInformation.city' => 'required|string|max:255',
            'order.shippingInformation.state' => 'required|string|max:255|in:' . implode(',', \App\Models\ShippingInformation::$states),
            'order.shippingInformation.country' => 'nullable|string|max:255',
            'order.shippingInformation.postal_code' => 'required|numeric',
            'order.payment_method' => 'required|string',
            'order.status' => 'required|string',
            'order.payment.status' => 'required|string',
            'order.paid_at' => 'nullable|date',
            'order.shipped_at' => 'nullable|date',
        ]);
    
        // Check if the order exists
        if (!$order->exists) {
            // Get the cart from session
            $cart = session('cart');
            $subtotal = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));
        }
    
        // Fill the order data
        $order->fill([
            'user_id' => auth()->id(),
            'status' => $request->input('order.status'),
            'subtotal' => $subtotal,
            'tax' => $subtotal * 0.1,  // Assuming 10% tax rate
            'shipping_fee' => 15,  // Assuming a flat rate shipping fee
            'total' => $subtotal * 1.1 + 15,
            'payment_method' => $request->input('order.payment_method'),
            'paid_at' => $request->input('order.paid_at'),
            'shipped_at' => $request->input('order.shipped_at'),
        ])->save();
    
        // Create or update the order items
        foreach ($cart as $item) {
            OrderItem::updateOrCreate(
                ['order_id' => $order->id, 'product_id' => $item['id']],
                ['quantity' => $item['quantity'], 'price' => $item['price'], 'subtotal' => $item['price'] * $item['quantity']]
            );
        }
    
        // Create or update the payment information
        $order->payment()->updateOrCreate(
            ['order_id' => $order->id],
            ['amount' => $order->total, 'payment_method' => $request->input('order.payment_method'), 'status' => $request->input('order.payment.status')]
        );
    
        // Create or update the shipping information
        $order->shippingInformation()->updateOrCreate(
            ['order_id' => $order->id],
            [
                'address_line1' => $request->input('order.shippingInformation.address_line1'),
                'address_line2' => $request->input('order.shippingInformation.address_line2'),
                'city' => $request->input('order.shippingInformation.city'),
                'state' => $request->input('order.shippingInformation.state'),
                'country' => $request->input('order.shippingInformation.country', 'Indonesia'),
                'postal_code' => $request->input('order.shippingInformation.postal_code')
            ]
        );
    
        // Clear the cart after the order is placed
        session()->forget('cart');
    
        // Display success message
        Alert::success('Order created or updated successfully.');
    
        // Redirect to the orders list
        return redirect()->route('platform.orders.list');
    }
    

}
