<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class OrderListScreen extends Screen
{
   /**
     * Query data.
     *
     * @return array
     */
    public function query(Request $request): array
    {
        // Build a query to fetch inquiries
        $query = Order::query();
        // If a search query is present, filter the inquiries
        if ($request->filled('search')) {
            // Validate the search term
            $request->validate([
                'search' => 'required|string|max:255',
            ]);
            // Get the search term from the request
            $search = $request->input('search');
            $query->where('status', 'like', "%{$search}%")
            ->orWhere('payment_status', 'like', "%{$search}%")
            ->orWhere('payment_method', 'like', "%{$search}%")
            ->orWhere('transaction_id', 'like', "%{$search}%")
            ->orWhere('total', 'like', "%{$search}%")
            ->orWhereHas('buyer', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        }
        return [
            'orders' => $query->with('payment', 'shippingInformation')->paginate()
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
        return [ // Search bar
            Layout::rows([
                Input::make('search')
                    ->type('text')
                    ->placeholder('Search...')
                    ->value(request()->query('search')),
                Button::make('Search')
                    ->method('handleSearch')  // Assuming you handle the request in a method called `search`
                    ->type(Color::SUCCESS())
                    ->icon('magnifier')
            ]),
            // Table
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
                TD::make('state', 'State')
                    ->render(function (Order $order) {
                        return $order->shippingInformation->state ?? 'N/A';
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
     // Used as button handler to reroute to the same page with search values saved
     public function handleSearch(Request $request)
     {
         // Get the search term from the request
         $searchTerm = $request->input('search');

         // Redirect back to the screen with the search parameter to show results
         return redirect()->route('platform.orders.list', ['search' => $searchTerm]);
     }
}
