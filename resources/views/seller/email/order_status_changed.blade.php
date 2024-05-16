<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بروزرسانی وضعیت سفارش</title>
</head>
<body style="background-color: #edf2f7; font-family: 'Tahoma', sans-serif; padding: 20px;">
<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 20px;">
    <h1 style="color: #4A90E2; text-align: center;">وضعیت سفارش شما بروزرسانی شده است</h1>
    <p style="color: #333; font-size: 16px; line-height: 1.5; margin-top: 12px;">سلام، <strong>{{ $order->cart->buyer->name }}</strong> عزیز!</p>
    <p style="color: #333; font-size: 16px; line-height: 1.5; margin-top: 12px;">سفارش شما با شماره <strong>#{{ $order->id }}</strong> هم اکنون در وضعیت <strong>«{{ $order->status->name }}»</strong> قرار دارد.</p>
    <p style="color: #333; font-size: 16px; line-height: 1.5; margin-top: 12px;">مجموع هزینه: <strong>{{ number_format($order->total_price, 2) }} تومان</strong></p>
    <p style="color: #666; font-size: 14px; line-height: 1.5; margin-top: 20px; text-align: center;">از خرید شما متشکریم!</p>
</div>
</body>
</html>
