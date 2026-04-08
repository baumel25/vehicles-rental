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
            background: #3e7bfa;
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
            <h1>New Assignment</h1>
        </div>
        <div class="content">
            <p>Hello {{ $reservation->driver->name }},</p>
            <p>You have a new booking assignment for a chauffeur service.</p>

            <div class="details">
                <div class="label">Customer</div>
                <div class="value">{{ $reservation->user->name }}</div>

                <div class="label">Vehicle</div>
                <div class="value">{{ $reservation->vehicle->name }}</div>

                <div class="label">Rental Period</div>
                <div class="value">{{ $reservation->pickup_date->format('M d, Y') }} to
                    {{ $reservation->return_date->format('M d, Y') }}</div>
            </div>

            <p>Please ensure you are available and prepared for this assignment. Contact the support team if you have
                any questions.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} LuxDrive Premium Rentals. All rights reserved.
        </div>
    </div>
</body>

</html>
