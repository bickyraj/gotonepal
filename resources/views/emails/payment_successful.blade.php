<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name') }}</title>
</head>
<body>
	<h3>Dear {{ $body['full_name'] }},</h3>

	<p>
        Thank you for booking your trip "{{ $body['trip_name'] }}" with us!. Your payment for the upcoming trip package has been successfully processed. We appreciate you choosing us for your travel adventure!</p>

        <p>
            Your booking is now confirmed, and we're looking forward to providing you with a fantastic travel experience. If you have any questions or require further assistance, please don't hesitate to reach out.
        </p>
    </p>
    <div>Best regards,</div>
    <div>{{ config('app.name') }}</div>
</body>
</html>
