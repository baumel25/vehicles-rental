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
            background: #ef4444;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Booking Update</h1>
        </div>
        <div class="content">
            <p>Hello {{ $reservation->user->name }},</p>
            <p>Thank you for your interest in LuxDrive. We regret to inform you that your booking request
                #RE{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }} has been declined at this time.</p>

            <p>This may be due to vehicle availability or scheduling conflicts. You are welcome to browse our fleet for
                alternative dates or models.</p>

            <p>If you have any questions, please contact our support team.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} LuxDrive Premium Rentals. All rights reserved.
        </div>
    </div>
</body>

</html>
