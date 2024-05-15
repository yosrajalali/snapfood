<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأیید سفارش</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.x/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<div style="background-color: #edf2f7; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; padding: 20px; text-align: center;">
        <h1>تأیید سفارش</h1>
        <p>از خرید شما متشکریم!</p>
        <p>سفارش شما با شماره <strong>#{{ $order->id }}</strong> با موفقیت پردازش شد.</p>
        <div style="background-color: #e2e8f0; padding: 20px; margin-top: 20px;">
            <p><strong>مجموع سفارش:</strong> {{ number_format($order->total_price, 2) }} تومان</p>
        </div>
        <p>با تشکر،<br>{{ config('app.name') }}</p>
    </div>
</div>
</body>
</html>

