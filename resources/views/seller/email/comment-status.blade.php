<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تغییر وضعیت نظر</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">تغییر وضعیت نظر</h1>
    <p class="text-gray-700 mb-2">وضعیت نظر شما با شماره <span class="font-semibold">{{ $comment->id }}</span> تغییر کرد.</p>
    <p class="text-gray-700 mb-2">وضعیت جدید: <span class="font-semibold">{{ $status }}</span></p>
    <p class="text-gray-700 mb-2">نظر: <span class="font-semibold">{{ $comment->comment }}</span></p>
    @if ($comment->response)
        <p class="text-gray-700 mt-4">پاسخ: <span class="font-semibold">{{ $comment->response }}</span></p>
    @endif
</div>
</body>
</html>
