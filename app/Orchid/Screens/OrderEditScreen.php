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
use Orchid\Screen\TD;
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
        $order->with(['buyer', 'payment', 'shippingInformation']);
        
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
            ->method('create')
            ->canSee(!$this->order->exists),

            Button::make('Update')
                ->icon('note')
                ->method('update')
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
        $orderExists = $this->order->exists;
        $layout = [];
        $formFields = Layout::rows([
             // Link to products page
             Link::make('Add Products')
             ->route('products.index')
             ->icon('plus'),
            // User field
            Select::make('order.user_id')
                ->title('Buyer')
                ->fromModel(User::class, 'name', 'id')
                ->value($orderExists ? $this->order->user_id : null),

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
                ->value($orderExists ? $this->order->status : null),

            // Financial Dates
            DateTimer::make('order.paid_at')
                ->title('Paid At')
                ->help('Please select the date and time of payment.')
                ->format('Y-m-d H:i')
                ->value($orderExists ? $this->order->paid_at : null),

            DateTimer::make('order.shipped_at')
                ->title('Shipped At')
                ->help('Please select the date and time of shipping.')
                ->format('Y-m-d H:i')
                ->value($orderExists ? $this->order->shipped_at : null),

            // Shipping information fields
            Input::make('order.shippingInformation.address_line1')
                ->title('Address Line 1')
                ->placeholder('Address Line 1')
                ->help('Enter the first line of the address')
                ->value($orderExists ? $this->order->shippingInformation->address_line1 : null),

            Input::make('order.shippingInformation.address_line2')
                ->title('Address Line 2')
                ->placeholder('Address Line 2')
                ->help('Enter the second line of the address')
                ->value($orderExists ? $this->order->shippingInformation->address_line2 : null),

            Input::make('order.shippingInformation.city')
                ->title('City')
                ->placeholder('City')
                ->help('Enter the city of the address')
                ->value($orderExists ? $this->order->shippingInformation->city : null),

            Select::make('order.shippingInformation.state')
                ->title('State')
                ->options(\App\Models\ShippingInformation::$states)
                ->help('Select the state of the address')
                ->value($orderExists ? $this->order->shippingInformation->state : null),

            Input::make('order.shippingInformation.country')
                ->title('Country')
                ->placeholder('Country')
                ->help('Enter the country of the address')
                ->value($orderExists ? $this->order->shippingInformation->country : null),

            Input::make('order.shippingInformation.postal_code')
                ->title('Postal Code')
                ->placeholder('Postal Code')
                ->help('Enter the postal code of the address')
                ->value($orderExists ? $this->order->shippingInformation->postal_code : null),

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
                ->value($orderExists ? $this->order->payment->payment_method : null),

            Select::make('order.payment_status')
                ->title('Payment Status')
                ->options([
                    'Paid' => 'Paid',
                    'Unpaid' => 'Unpaid',
                    'Refunded' => 'Refunded',
                    'Cancelled' => 'Cancelled',
                    'Pending' => 'Pending',
                ])
                ->help('Select the payment status of the order')
                ->value($orderExists ? $this->order->payment->status : null),
            ]);
        
            // If new item, add the current cart to the view
            if (!$this->order->exists) {
                $layout = [
                Layout::view('cart._cart'), // Include the cart view
               
                // Existing layout elements
                $formFields,
            ];
                
            } else {
                // Print out existing order items associated with order
                // $orderItems = $this->order->items;
                $orderItemTable = Layout::table('orderItems', [
                        TD::make('orderItems', 'Order Items')
                            ->render(function (Order $order) {
                        return $order->items->map(function ($item) {
                            return $item->product_name . ' (x' . $item->quantity . ')';
                        })->implode('<br>');
                    }),
                        ]);
                   
                
                $layout = [
                    $orderItemTable,
                    $formFields
                ];
            }

       
        return $layout;
    }
    public function create(Request $request)
    {
        // Validate the request
        $request->validate([
            'order.shippingInformation.address_line1' => 'required|string|max:255|min:5',
            'order.shippingInformation.address_line2' => 'nullable|string|max:255',
            'order.shippingInformation.city' => 'required|string|max:255',
            'order.shippingInformation.state' => 'required|string|max:255|in:' . implode(',', \App\Models\ShippingInformation::$states),
            'order.shippingInformation.country' => 'nullable|string|max:255',
            'order.shippingInformation.postal_code' => 'required|numeric',
            'order.payment_method' => 'required|string',
            'order.status' => 'required|string',
            'order.payment_status' => 'required|string',
            'order.paid_at' => 'nullable|date',
            'order.shipped_at' => 'nullable|date',
        ]);

        // Creating a new order
        $cart = session('cart');
        $subtotal = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $order = new Order();
        // Fill the order data
        $order->fill([
            'user_id' => $request->input('order.user_id'),
            'status' => $request->input('order.status'),
            'subtotal' => $subtotal,
            'tax' => $subtotal * 0.1,  // Assuming 10% tax rate
            'shipping_fee' => 15,  // Assuming a flat rate shipping fee
            'total' => $subtotal * 1.1 + 15,
            'paid_at' => $request->input('order.paid_at'),
            'shipped_at' => $request->input('order.shipped_at'),
        ]);

        $order->save();

        // Create the order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // Create the payment information
        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method' => $request->input('order.payment_method'),
            'status' => $request->input('order.payment_status'),
        ]);

        // Create the shipping information
        ShippingInformation::create([
            'order_id' => $order->id,
            'address_line1' => $request->input('order.shippingInformation.address_line1'),
            'address_line2' => $request->input('order.shippingInformation.address_line2'),
            'city' => $request->input('order.shippingInformation.city'),
            'state' => $request->input('order.shippingInformation.state'),
            'country' => $request->input('order.shippingInformation.country'),
            'postal_code' => $request->input('order.shippingInformation.postal_code'),
            // 'country' is nullable, but make default 'Indonesia'
            'country' => 'Indonesia',
        ]);

        // Clear the cart after the order is placed
        session()->forget('cart');

        // Display success message
        Alert::success('Order created successfully.');

        // Redirect to the orders list
        return redirect()->route('platform.orders.list');
    }

    public function update(Order $order, Request $request)
    {
        // Validate the request
        $request->validate([
            'order.shippingInformation.address_line1' => 'required|string|max:255|min:5',
            'order.shippingInformation.address_line2' => 'nullable|string|max:255',
            'order.shippingInformation.city' => 'required|string|max:255',
            'order.shippingInformation.state' => 'required|string|max:255|in:' . implode(',', \App\Models\ShippingInformation::$states),
            'order.shippingInformation.country' => 'nullable|string|max:255',
            'order.shippingInformation.postal_code' => 'required|numeric',
            'order.payment_method' => 'required|string',
            'order.status' => 'required|string',
            'order.payment_status' => 'required|string',
            'order.paid_at' => 'nullable|date',
            'order.shipped_at' => 'nullable|date',
        ]);

        // Updating an existing order
        $order->fill([
            'status' => $request->input('order.status'),
            'paid_at' => $request->input('order.paid_at'),
            'shipped_at' => $request->input('order.shipped_at'),
        ]);

        $order->save();

        // Update the payment information
        $order->payment->update([
            'payment_method' => $request->input('order.payment_method'),
            'status' => $request->input('order.payment_status'),
        ]);

        // Update the shipping information
        $order->shippingInformation->update([
            'address_line1' => $request->input('order.shippingInformation.address_line1'),
            'address_line2' => $request->input('order.shippingInformation.address_line2'),
            'city' => $request->input('order.shippingInformation.city'),
            'state' => $request->input('order.shippingInformation.state'),
            'country' => $request->input('order.shippingInformation.country'),
            'postal_code' => $request->input('order.shippingInformation.postal_code'),
        ]);

        // Display success message
        Alert::success('Order updated successfully.');

        // Redirect to the orders list
        return redirect()->route('platform.orders.list');
    }
    
    public function remove(Order $order)
    {
        // Delete the order
        $order->delete();
    
        // Display success message
        Alert::success('Order deleted successfully.');
    
        // Redirect to the orders list
        return redirect()->route('platform.orders.list');
    }

}
