<!DOCTYPE html>
<html>

<head>
    <title>Go To Nepal</title>
</head>

<body>
    <h3>Booking</h3>

    from: {{ $body['fullname'] }} <br />
    email: {{ $body['email'] }} <br />
    trip: {{ $trip_name }} <br />
    contact number: {{ $body['contact_number'] }} <br />
    <!-- amount paid: {{ $body['price'] }} <br /> -->
</body>

</html>
