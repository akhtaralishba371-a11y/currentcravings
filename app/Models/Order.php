<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'customer_name', 'customer_email', 'customer_phone',
        'shipping_address', 'city', 'postcode', 'delivery_slot', 'order_notes',
        'subtotal', 'discount', 'delivery_fee', 'total', 'promo_code',
        'payment_method', 'payment_status', 'order_status',
        'stripe_checkout_session_id', 'stripe_payment_intent_id', 'stripe_customer_id',
        'paid_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber()
    {
        $prefix = 'CC';
        $date = now()->format('Ymd');
        $lastOrder = self::whereDate('created_at', today())->latest()->first();
        $sequence = $lastOrder ? intval(substr($lastOrder->order_number, -4)) + 1 : 1;
        return $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'preparing' => 'bg-purple-100 text-purple-800',
            'out_for_delivery' => 'bg-orange-100 text-orange-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];
        return $badges[$this->order_status] ?? 'bg-gray-100 text-gray-800';
    }
}
