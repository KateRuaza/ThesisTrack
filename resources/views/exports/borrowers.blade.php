<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<table>
	    <thead>
	        <tr>
	            <th style="text-align: left; font-weight: bold;">Name</th>
	            <th style="text-align: left; font-weight: bold;">Email</th>
	            <th style="text-align: left; font-weight: bold;">Contact #</th>
	            <th style="text-align: left; font-weight: bold;">Address</th>
	            <th style="text-align: left; font-weight: bold;">Thesis</th>
	            <th style="text-align: left; font-weight: bold;">Borrowed</th>
	            <th style="text-align: left; font-weight: bold;">Returned</th>
	            <th style="text-align: left; font-weight: bold;">First Warning</th>
	            <th style="text-align: left; font-weight: bold;">Last Warning</th>
	            <th style="text-align: left; font-weight: bold;">Status</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach ($borrowers as $borrower)
	            <tr>
	                <td>{{ $borrower->name }}</td>
	                <td>{{ $borrower->email }}</td>
	                <td>{{ $borrower->contact_number }}</td>
	                <td>{{ $borrower->address }}</td>
	                <td>{{ $borrower->thesis_name }}</td>
	                <td>{{ $borrower->created_at->format('Y-m-d') }}</td>
	                <td>{{ $borrower->returned_at ? $borrower->returned_at->format('Y-m-d') : 'N/A' }}</td>
	                <td>{{ $borrower->first_warning ? 'Sent' : 'Not Sent' }}</td>
	                <td>{{ $borrower->last_warning ? 'Sent' : 'Not Sent' }}</td>
	                <td>{{ ucfirst($borrower->status) }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	</table>
</body>
</html>