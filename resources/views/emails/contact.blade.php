<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3>Enquiry</h3>

	Name: {{ $body['name'] ?? '' }} <br>
	Email: {{ $body['email'] ?? '' }} <br>
	Country: {{ $body['country'] ?? '' }} <br>
	Phone No: {{ $body['phone'] ?? '' }} <br>
	Message: {{ $body['message'] ?? '' }} <br>
    @if (isset($body['start_date']) && !empty($body['start_date'])
    || isset($body['end_date']) && !empty($body['end_date']))
        Start Date: {{ $body['start_date'] ?? '' }} <br>
        End Date: {{ $body['end_date'] ?? '' }} <br>
    @endif
    @if (isset($body['no_of_traveller']) && !empty($body['no_of_traveller']))
        No. of Traveller: {{ $body['no_of_traveller'] ?? '' }} <br>
    @endif
    @if (isset($body['redirect_url']) && !empty($body['redirect_url']))
        Requested from trip page: <a href="{{ $body['redirect_url'] }}">{{ $body['redirect_url'] }}</a>
    @endif

	<h4>Traveller Information</h4>
	IP Address: {{ $body['ip_address'] }}
</body>
</html>
