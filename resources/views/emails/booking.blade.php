<!DOCTYPE html>
<html>
<head>
	<title>Go To Nepal</title>
</head>
<body>
	<h3>Booking</h3>

    from: {{ $body['first_name']. " " . $body['middle_name'] . " " . $body['last_name'] }} <br/>
    when: <br/>
    country: {{ $body['country'] }} <br/>
    departure date: {{ $body['preferred_departure_date'] }} <br/>
    email: {{ $body['email'] }} <br/>
    trip: {{ $trip_name }} <br/>
    contact number: {{ $body['contact_no'] }} <br/>
    gender: {{ $body['gender'] }} <br/>
    no of traveller: {{ $body['no_of_travellers'] }} <br/>
    emergency contact: {{ $body['emergency_contact'] }} <br/>
    payment type: {{ $body['payment_type'] }} <br/>
</body>
</html>
