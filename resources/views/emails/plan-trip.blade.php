<!DOCTYPE html>
<html>
<head>
	<title>Go To Nepal</title>
</head>
<body>
	<h3>Booking</h3>

    who: {{ $body['who'] }} <br/>
    no of adults: {{ $body['no_of_adults'] }} <br/>
    no of children: {{ $body['no_of_children'] }} <br/>
    when: <br/>
    arrival date: {{ $body['arrival_date'] }} <br/>
    departure date: {{ $body['departure_date'] }} <br/>
    month: {{ $body['month'] }} <br/>
    destination: {{ $destinations }} <br/>
    trip interested: {{ $trips }} <br/>
    accomodation: {{ $body['accomodation'] }} <br/>
    @php
        $amount = explode(",", $body['amount']);
        $amount = "$".$amount[0] . " - " . "$" . $amount[1];
    @endphp

    amount range: {{ $amount }} <br/>
    flexible: {{ $body['flexible'] }} <br/>
    trip type: {{ $body['trip_type'] }} <br/>
    plan phase: {{ $body['plan_phase'] }} <br/>
    additional queries: {{ $body['additional_queries'] }} <br/>
    reached by: {{ $body['reached_by'] }} <br/>
    first name: {{ $body['first_name'] }} <br/>
    last name: {{ $body['last_name'] }} <br/>
    contact number: {{ $body['contact_number'] }} <br/>
    email: {{ $body['email'] }} <br/>
    nationality: {{ $body['country'] }} <br/>
    contact method: {{ $body['contact_method'] }} <br/>
    IP Address: <a href="https://www.ip2location.com/demo/{{ $body['ip_address'] }}">{{ $body['ip_address'] }}</a>
</body>
</html>
