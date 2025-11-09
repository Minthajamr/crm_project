<!DOCTYPE html>
<html>
<head>
    <title>Payment Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h1 class="text-2xl font-bold mb-6">Invoice Payment</h1>
            
            <div class="mb-6">
                <p class="text-gray-600">Invoice Number:</p>
                <p class="font-bold text-xl">{{ $invoice->invoice_number }}</p>
            </div>

            <div class="mb-6">
                <p class="text-gray-600">Description:</p>
                <p>{{ $invoice->description }}</p>
            </div>

            <div class="mb-6">
                <p class="text-gray-600">Amount Due:</p>
                <p class="font-bold text-2xl text-green-600">${{ number_format($invoice->total, 2) }}</p>
            </div>

            <form action="{{ route('payment.process', $invoice) }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">
                    Proceed to Payment
                </button>
            </form>
        </div>
    </div>
</body>
</html>