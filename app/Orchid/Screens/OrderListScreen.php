<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use App\Models\ShippingInformation;
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

         // Apply filters
         if ($request->filled('filter')) {
            $filters = $request->input('filter');

            if (!empty($filters['status'])) {
                $statuses = is_array($filters['status']) ? $filters['status'] : explode(',', $filters['status']);
                $query->whereIn('status', $statuses);
            }
            if (!empty($filters['payment_status'])) {
                $statuses = is_array($filters['payment_status']) ? $filters['payment_status'] : explode(',', $filters['payment_status']);
                $query->whereIn('payment_status', $statuses);
            }
            if (!empty($filters['payment_method'])) {
                $methods = is_array($filters['payment_method']) ? $filters['payment_method'] : explode(',', $filters['payment_method']);
                $query->whereIn('payment_method', $methods);
            }
            // Foreign data filters
            if (!empty($filters['state'])) {
                $query->whereHas('shippingInformation', function ($query) use ($filters) {
                    $states = is_array($filters['state']) ? $filters['state'] : explode(',', $filters['state']);
                    $query->whereIn('state', $states);
                });
            }

            // Dates
            if (!empty($filters['shipped_at'])) {
                $dateRange = $request->input('filter.shipped_at');
                $startDate = $dateRange['start'] ?? null;
                $endDate = $dateRange['end'] ?? null;

                // Apply date range to query if both dates are available
                if ($startDate && $endDate) {
                    $query->whereBetween('shipped_at', [$startDate, $endDate]);
                }
            }
            if (!empty($filters['paid_at'])) {
                $dateRange = $request->input('filter.paid_at');
                $startDate = $dateRange['start'] ?? null;
                $endDate = $dateRange['end'] ?? null;

                // Apply date range to query if both dates are available
                if ($startDate && $endDate) {
                    $query->whereBetween('paid_at', [$startDate, $endDate]);
                }
            }
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
                    })
                    ->filter(TD::FILTER_SELECT, ShippingInformation::$states),
               TD::make('status', 'Status')
               ->filter(TD::FILTER_SELECT, [
                   'Pending' => 'Pending',
                   'Processing' => 'Processing',
                   'Completed' => 'Completed',
                   'Cancelled' => 'Cancelled',
                   'Refunded' => 'Refunded',
                ]),
                TD::make('total', 'Total'),
                TD::make('subtotal', 'Subtotal'),
                TD::make('tax', 'Tax'),
                TD::make('shipping_fee', 'Shipping Fee'),
                TD::make('payment_status', 'Payment Status')
                ->filter(TD::FILTER_SELECT, [
                    'Paid' => 'Paid',
                    'Unpaid' => 'Unpaid',
                    'Pending' => 'Pending',
                    'Refunded' => 'Refunded',
                    'Cancelled' => 'Cancelled',
                ]),
                TD::make('payment_method', 'Payment Method')
                ->filter(TD::FILTER_SELECT, [
                    'Credit Card' => 'Credit Card',
                    'PayPal' => 'PayPal',
                    'Stripe' => 'Stripe',
                    'Cash on Delivery' => 'Cash on Delivery',
                ]),
                TD::make('transaction_id', 'Transaction ID'),
                TD::make('paid_at', 'Paid At')
                ->filter(TD::FILTER_DATE_RANGE)
                ->render(function ($model) {
                    return $model->paid_at ? $model->paid_at : '';
                }),
                TD::make('shipped_at', 'Shipped At')
                ->filter(TD::FILTER_DATE_RANGE)
                ->render(function ($model) {
                    return $model->shipped_at ? $model->shipped_at : '';
                }),
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
