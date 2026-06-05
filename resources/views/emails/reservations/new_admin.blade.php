<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Inter', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 10px;
        }

        .header {
            background: #1e1e2d;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            padding: 30px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #888;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #3e7bfa;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .details {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .label {
            font-weight: bold;
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
        }

        .value {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>New Reservation</h1>
        </div>
        <div class="content">
            <p>Hello Admin,</p>
            <p>A new reservation request has been received on LuxDrive.</p>

            <div class="details">
                <div class="label">Customer</div>
                <div class="value">{{ $reservation->user->name }}</div>

                <div class="label">Vehicle</div>
                <div class="value">{{ $reservation->vehicle->name }}</div>

                <div class="label">Period</div>
                <div class="value">{{ $reservation->pickup_date->format('M d') }} -
                    {{ $reservation->return_date->format('M d, Y') }}</div>

                <div class="label">Total Amount</div>
                <div class="value">{{ number_format($reservation->total_price, 0) }} FCFA</div>
            </div>

            <p style="text-align: center;">
                <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="btn">View Details</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} LuxDrive Premium Rentals. All rights reserved.
        </div>
    </div>
</body>

</html>
