<!DOCTYPE html>
<html>
<head>
    <title>Payment Cancelled</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">
            <div class="text-red-500 text-6xl mb-4">✕</div>
            <h1 class="text-2xl font-bold mb-4">Payment Cancelled</h1>
            <p class="text-gray-600 mb-6">Your payment was cancelled. You can try again anytime.</p>
            <a href="{{ route('payment.checkout', $invoice) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">
                Try Again
            </a>
        </div>
    </div>
</body>
</html>