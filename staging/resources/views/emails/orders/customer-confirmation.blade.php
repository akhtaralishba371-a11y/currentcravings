<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
@php
    $firstName = trim((string) explode(' ', trim((string) $order->customer_name))[0]);
    $firstName = $firstName !== '' ? $firstName : 'there';

    $pickupDate = 'To be confirmed';
    $pickupTime = 'To be confirmed';
    $slotRaw = trim((string) ($order->delivery_slot ?? ''));
    if ($slotRaw !== '') {
        try {
            $slot = \Illuminate\Support\Carbon::parse($slotRaw);
            $pickupDate = $slot->format('D, d M Y');
            $pickupTime = $slot->format('h:i A');
        } catch (\Throwable $e) {
            $pickupDate = $slotRaw;
            $pickupTime = '';
        }
    }

    $fulfillmentMethod = filled($order->shipping_address) ? 'Delivery' : 'Pickup';
    $displayPhone = trim((string) ($bakeryPhone ?? '')) !== '' ? $bakeryPhone : $order->customer_phone;
    $displayAddress = trim((string) ($companyAddress ?? '')) !== '' ? $companyAddress : ($order->shipping_address.', '.$order->city.' '.$order->postcode);
@endphp
<body style="margin: 0; padding: 0; background-color: #f4f4f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f4f5;">
    <tr>
      <td style="padding: 40px 20px;">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
          <tr>
            <td style="padding: 32px 40px 0 40px;">
              <p style="margin: 0 0 24px 0; color: #f97316; font-weight: 600; font-size: 14px;">{{ $companyName }}</p>
            </td>
          </tr>
          <tr>
            <td style="padding: 0 40px 32px 40px;">
              <h1 style="margin: 0 0 16px 0; color: #18181b; font-size: 28px; font-weight: 700; line-height: 1.3;">Order Confirmed</h1>
              <p style="margin: 0 0 24px 0; color: #3f3f46; font-size: 15px; line-height: 1.6;">Hi {{ $firstName }}, thank you for your order! We are preparing everything fresh for you.</p>

              <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 24px 0; border: 1px solid #e4e4e7; border-radius: 6px;">
                <tr>
                  <td style="padding: 16px 20px; background-color: #fff7ed; border-bottom: 1px solid #e4e4e7;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                      <tr>
                        <td><p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 600;">Order #{{ $order->order_number }}</p></td>
                        <td style="text-align: right;"><p style="margin: 0; color: #16a34a; font-size: 13px; font-weight: 600;">Confirmed</p></td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 12px 20px; border-bottom: 1px solid #e4e4e7;">
                    <p style="margin: 0 0 2px 0; color: #71717a; font-size: 13px;">Delivery Date</p>
                    <p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 500;">
                        {{ $pickupDate }}@if($pickupTime !== '') at {{ $pickupTime }}@endif
                    </p>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 12px 20px;">
                    <p style="margin: 0 0 2px 0; color: #71717a; font-size: 13px;">Fulfillment</p>
                    <p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 500;">{{ $fulfillmentMethod }}</p>
                  </td>
                </tr>
              </table>

              <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 4px 0;">
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #e4e4e7;">
                    <p style="margin: 0; color: #71717a; font-size: 13px; font-weight: 600;">ITEM</p>
                  </td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #e4e4e7; text-align: center;">
                    <p style="margin: 0; color: #71717a; font-size: 13px; font-weight: 600;">QTY</p>
                  </td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #e4e4e7; text-align: right;">
                    <p style="margin: 0; color: #71717a; font-size: 13px; font-weight: 600;">PRICE</p>
                  </td>
                </tr>
              </table>
              <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 16px 0;">
                @foreach ($order->items as $item)
                @php
                    $variantDetails = '';
                    if (is_array($item->variant) && !empty($item->variant)) {
                        $variantDetails = collect($item->variant)
                            ->map(fn ($value, $key) => ucfirst((string) $key).': '.(is_array($value) ? implode(', ', $value) : (string) $value))
                            ->implode(' | ');
                    }
                @endphp
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #f4f4f5;">
                    <p style="margin: 0; color: #18181b; font-size: 14px;">{{ $item->product_name }}</p>
                    @if ($variantDetails !== '')
                        <p style="margin: 2px 0 0 0; color: #71717a; font-size: 12px;">{{ $variantDetails }}</p>
                    @endif
                  </td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #f4f4f5; text-align: center;">
                    <p style="margin: 0; color: #3f3f46; font-size: 14px;">{{ (int) $item->quantity }}</p>
                  </td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #f4f4f5; text-align: right;">
                    <p style="margin: 0; color: #3f3f46; font-size: 14px;">GBP {{ number_format((float) $item->price * (int) $item->quantity, 2) }}</p>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="2" style="padding: 12px 0 0 0;">
                    <p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 600;">Total</p>
                  </td>
                  <td style="padding: 12px 0 0 0; text-align: right;">
                    <p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 600;">GBP {{ number_format((float) $order->total, 2) }}</p>
                  </td>
                </tr>
              </table>

              <p style="margin: 0 0 24px 0; color: #3f3f46; font-size: 15px; line-height: 1.6;">If you need to make any changes, please contact us at {{ $displayPhone }} at least 24 hours before your pickup time.</p>

              <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                <tr>
                  <td style="padding: 14px 28px; background-color: #f97316; border-radius: 6px;">
                    <a href="{{ $orderStatusUrl }}" style="color: #ffffff; text-decoration: none; font-weight: 600; font-size: 15px;">View Order Status</a>
                  </td>
                </tr>
              </table>

              <p style="margin: 24px 0 0 0; color: #3f3f46; font-size: 15px; line-height: 1.6;">Thank you,<br>The {{ $companyName }} Team</p>
            </td>
          </tr>
          <tr>
            <td style="padding: 24px 40px; background-color: #fafafa; border-top: 1px solid #e4e4e7;">
              <p style="margin: 0; color: #71717a; font-size: 12px; text-align: center;">{{ $companyName }} | {{ $displayAddress }}</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
@php
    $firstName = trim((string) explode(' ', trim((string) $order->customer_name))[0]);
    $firstName = $firstName !== '' ? $firstName : 'there';

    $pickupDate = 'To be confirmed';
    $pickupTime = 'To be confirmed';
    $slotRaw = trim((string) ($order->delivery_slot ?? ''));
    if ($slotRaw !== '') {
        try {
            $slot = \Illuminate\Support\Carbon::parse($slotRaw);
            $pickupDate = $slot->format('D, d M Y');
            $pickupTime = $slot->format('h:i A');
        } catch (\Throwable $e) {
            $pickupDate = $slotRaw;
            $pickupTime = '';
        }
    }

    $fulfillmentMethod = filled($order->shipping_address) ? 'Delivery' : 'Pickup';
    $displayPhone = trim((string) ($bakeryPhone ?? '')) !== '' ? $bakeryPhone : $order->customer_phone;
    $displayAddress = trim((string) ($companyAddress ?? '')) !== '' ? $companyAddress : ($order->shipping_address.', '.$order->city.' '.$order->postcode);
@endphp
<body style="margin: 0; padding: 0; background-color: #f4f4f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f4f5;">
    <tr>
      <td style="padding: 40px 20px;">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
          <tr>
            <td style="padding: 32px 40px 0 40px;">
              <p style="margin: 0 0 24px 0; color: #f97316; font-weight: 600; font-size: 14px;">{{ $companyName }}</p>
            </td>
          </tr>
          <tr>
            <td style="padding: 0 40px 32px 40px;">
              <h1 style="margin: 0 0 16px 0; color: #18181b; font-size: 28px; font-weight: 700; line-height: 1.3;">Order Confirmed</h1>
              <p style="margin: 0 0 24px 0; color: #3f3f46; font-size: 15px; line-height: 1.6;">Hi {{ $firstName }}, thank you for your order! We are preparing everything fresh for you.</p>

              <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 24px 0; border: 1px solid #e4e4e7; border-radius: 6px;">
                <tr>
                  <td style="padding: 16px 20px; background-color: #fff7ed; border-bottom: 1px solid #e4e4e7;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                      <tr>
                        <td><p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 600;">Order #{{ $order->order_number }}</p></td>
                        <td style="text-align: right;"><p style="margin: 0; color: #16a34a; font-size: 13px; font-weight: 600;">Confirmed</p></td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 12px 20px; border-bottom: 1px solid #e4e4e7;">
                    <p style="margin: 0 0 2px 0; color: #71717a; font-size: 13px;">Delivery Date</p>
                    <p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 500;">
                        {{ $pickupDate }}@if($pickupTime !== '') at {{ $pickupTime }}@endif
                    </p>
                  </td>
                </tr>
                <tr>
                  <td style="padding: 12px 20px;">
                    <p style="margin: 0 0 2px 0; color: #71717a; font-size: 13px;">Fulfillment</p>
                    <p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 500;">{{ $fulfillmentMethod }}</p>
                  </td>
                </tr>
              </table>

              <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 4px 0;">
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #e4e4e7;">
                    <p style="margin: 0; color: #71717a; font-size: 13px; font-weight: 600;">ITEM</p>
                  </td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #e4e4e7; text-align: center;">
                    <p style="margin: 0; color: #71717a; font-size: 13px; font-weight: 600;">QTY</p>
                  </td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #e4e4e7; text-align: right;">
                    <p style="margin: 0; color: #71717a; font-size: 13px; font-weight: 600;">PRICE</p>
                  </td>
                </tr>
              </table>
              <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 0 16px 0;">
                @foreach ($order->items as $item)
                @php
                    $variantDetails = '';
                    if (is_array($item->variant) && !empty($item->variant)) {
                        $variantDetails = collect($item->variant)
                            ->map(fn ($value, $key) => ucfirst((string) $key).': '.(is_array($value) ? implode(', ', $value) : (string) $value))
                            ->implode(' | ');
                    }
                @endphp
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #f4f4f5;">
                    <p style="margin: 0; color: #18181b; font-size: 14px;">{{ $item->product_name }}</p>
                    @if ($variantDetails !== '')
                        <p style="margin: 2px 0 0 0; color: #71717a; font-size: 12px;">{{ $variantDetails }}</p>
                    @endif
                  </td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #f4f4f5; text-align: center;">
                    <p style="margin: 0; color: #3f3f46; font-size: 14px;">{{ (int) $item->quantity }}</p>
                  </td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #f4f4f5; text-align: right;">
                    <p style="margin: 0; color: #3f3f46; font-size: 14px;">GBP {{ number_format((float) $item->price * (int) $item->quantity, 2) }}</p>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="2" style="padding: 12px 0 0 0;">
                    <p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 600;">Total</p>
                  </td>
                  <td style="padding: 12px 0 0 0; text-align: right;">
                    <p style="margin: 0; color: #18181b; font-size: 15px; font-weight: 600;">GBP {{ number_format((float) $order->total, 2) }}</p>
                  </td>
                </tr>
              </table>

              <p style="margin: 0 0 24px 0; color: #3f3f46; font-size: 15px; line-height: 1.6;">If you need to make any changes, please contact us at {{ $displayPhone }} at least 24 hours before your pickup time.</p>

              <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                <tr>
                  <td style="padding: 14px 28px; background-color: #f97316; border-radius: 6px;">
                    <a href="{{ $orderStatusUrl }}" style="color: #ffffff; text-decoration: none; font-weight: 600; font-size: 15px;">View Order Status</a>
                  </td>
                </tr>
              </table>

              <p style="margin: 24px 0 0 0; color: #3f3f46; font-size: 15px; line-height: 1.6;">Thank you,<br>The {{ $companyName }} Team</p>
            </td>
          </tr>
          <tr>
            <td style="padding: 24px 40px; background-color: #fafafa; border-top: 1px solid #e4e4e7;">
              <p style="margin: 0; color: #71717a; font-size: 12px; text-align: center;">{{ $companyName }} | {{ $displayAddress }}</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>

