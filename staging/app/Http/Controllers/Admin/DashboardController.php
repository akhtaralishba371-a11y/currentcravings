<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Revenue last 7 days
        $revenue7days = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo)->toDateString();
            $revenue = Order::query()
                ->where('payment_status', 'paid')
                ->whereDate('created_at', $date)
                ->sum('total');
            return ['date' => now()->subDays($daysAgo)->format('D d'), 'revenue' => (float) $revenue];
        });

        // Order status counts
        $orderStatusCounts = Order::query()
            ->select('order_status', DB::raw('count(*) as count'))
            ->groupBy('order_status')
            ->pluck('count', 'order_status')
            ->toArray();

        // Top products by revenue
        $topProducts = OrderItem::query()
            ->select('product_name', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(price * quantity) as total_revenue'))
            ->groupBy('product_name')
            ->orderByDesc('total_revenue')
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            'counts' => [
                'categories'       => Category::query()->count(),
                'products'         => Product::query()->count(),
                'blog_posts'       => BlogPost::query()->count(),
                'testimonials'     => Testimonial::query()->count(),
                'contact_messages' => ContactMessage::query()->count(),
                'orders'           => Order::query()->count(),
            ],
            'unread_messages'     => ContactMessage::query()->where('is_read', false)->count(),
            'pending_orders'      => Order::query()->where('order_status', 'pending')->count(),
            'total_revenue'       => Order::query()->where('payment_status', 'paid')->sum('total'),
            'recent_orders'       => Order::query()->latest()->limit(5)->get(),
            'recent_messages'     => ContactMessage::query()->latest()->limit(5)->get(),
            'revenue_7days'       => $revenue7days,
            'order_status_counts' => $orderStatusCounts,
            'top_products'        => $topProducts,
        ]);
    }
}
