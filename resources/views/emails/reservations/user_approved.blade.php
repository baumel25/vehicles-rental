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
            background: #10b981;
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
            <h1>Booking Confirmed!</h1>
        </div>
        <div class="content">
            <p>Hello {{ $reservation->user->name }},</p>
            <p>Your booking with LuxDrive has been approved. We're getting your vehicle ready for your upcoming journey!
            </p>

            <div class="details">
                <div class="label">Reservation ID</div>
                <div class="value">#RE{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}</div>

                <div class="label">Vehicle</div>
                <div class="value">{{ $reservation->vehicle->name }}</div>

                <div class="label">Dates</div>
                <div class="value">{{ $reservation->pickup_date->format('M d, Y') }} to
                    {{ $reservation->return_date->format('M d, Y') }}</div>

                @if ($reservation->driver)
                    <div class="label">Assigned Chauffeur</div>
                    <div class="value">{{ $reservation->driver->name }}</div>
                @endif
            </div>

            <p style="text-align: center;">
                <a href="{{ url('/') }}" class="btn">Manage Booking</a>
            </p>

            <p>Safe travels!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} LuxDrive Premium Rentals. All rights reserved.
        </div>
    </div>
</body>

</html>
