<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
</head>
<body>
    <h1>Invoice #{{ $invoice->invoice_number }}</h1>
    <p>Dear {{ $invoice->customer->name }},</p>
    <p>Please find your invoice details below:</p>
    
    <table>
        <tr>
            <td><strong>Description:</strong></td>
            <td>{{ $invoice->description }}</td>
        </tr>
        <tr>
            <td><strong>Amount:</strong></td>
            <td>${{ number_format($invoice->amount, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Tax:</strong></td>
            <td>${{ number_format($invoice->tax, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Total:</strong></td>
            <td><strong>${{ number_format($invoice->total, 2) }}</strong></td>
        </tr>
        <tr>
            <td><strong>Due Date:</strong></td>
            <td>{{ $invoice->due_date->format('M d, Y') }}</td>
        </tr>
    </table>

    <p>
        <a href="{{ route('payment.checkout', $invoice->id) }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 20px;">
            Pay Now
        </a>
    </p>

    <p>Thank you for your business!</p>
</body>
</html>