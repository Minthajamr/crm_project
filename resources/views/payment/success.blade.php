<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
            <div class="text-green-500 text-6xl mb-4">✓</div>
            <h1 class="text-2xl font-bold mb-4">Payment Successful!</h1>
            <p class="text-gray-600 mb-6">Your payment for invoice #{{ $invoice->invoice_number }} has been processed successfully.</p>
            <p class="text-xl font-bold text-green-600 mb-6">${{ number_format($invoice->total, 2) }}</p>
            <p class="text-sm text-gray-500">Thank you for your payment!</p>
        </div>
    </div>
</body>
</html>