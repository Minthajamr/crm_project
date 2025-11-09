<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 0 0 5px 5px;
        }
        .success-icon {
            font-size: 48px;
            color: #4CAF50;
            text-align: center;
            margin: 20px 0;
        }
        .details {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .details-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .details-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
        .value {
            color: #333;
        }
        .amount {
            font-size: 24px;
            color: #4CAF50;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Payment Successful!</h1>
        </div>
        
        <div class="content">
            <div class="success-icon">✓</div>
            
            <h2 style="text-align: center; color: #333;">Thank You for Your Payment</h2>
            
            <p>Dear {{ $invoice->customer->name }},</p>
            
            <p>We have successfully received your payment. Your transaction has been completed and a receipt has been generated for your records.</p>
            
            <div class="amount">
                ${{ number_format($transaction->amount, 2) }}
            </div>
            
            <div class="details">
                <h3 style="margin-top: 0; color: #333;">Payment Details</h3>
                
                <div class="details-row">
                    <span class="label">Transaction ID:</span>
                    <span class="value">{{ $transaction->transaction_id }}</span>
                </div>
                
                <div class="details-row">
                    <span class="label">Invoice Number:</span>
                    <span class="value">{{ $invoice->invoice_number }}</span>
                </div>
                
                <div class="details-row">
                    <span class="label">Payment Method:</span>
                    <span class="value">{{ ucfirst($transaction->payment_method) }}</span>
                </div>
                
                <div class="details-row">
                    <span class="label">Payment Date:</span>
                    <span class="value">{{ $transaction->created_at->format('F d, Y \a\t h:i A') }}</span>
                </div>
                
                <div class="details-row">
                    <span class="label">Amount Paid:</span>
                    <span class="value">${{ number_format($transaction->amount, 2) }}</span>
                </div>
                
                <div class="details-row">
                    <span class="label">Status:</span>
                    <span class="value" style="color: #4CAF50; font-weight: bold;">{{ ucfirst($transaction->status) }}</span>
                </div>
            </div>
            
            <div style="background-color: #e8f5e9; padding: 15px; border-radius: 5px; margin: 20px 0;">
                <h3 style="margin-top: 0; color: #2e7d32;">Invoice Information</h3>
                <p style="margin: 5px 0;"><strong>Description:</strong> {{ $invoice->description }}</p>
                <p style="margin: 5px 0;"><strong>Invoice Date:</strong> {{ $invoice->created_at->format('F d, Y') }}</p>
            </div>
            
            <p>If you have any questions about this payment, please don't hesitate to contact us.</p>
            
            <p style="margin-top: 30px;">Best regards,<br>
            <strong>{{ config('app.name') }} Team</strong></p>
        </div>
        
        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>