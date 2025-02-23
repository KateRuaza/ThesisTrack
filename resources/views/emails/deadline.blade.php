<!DOCTYPE html>
<html>
<head>
    <title>Deadline Reminder</title>
</head>
<body>
    <p>Dear {{ $borrower->name }},</p>

    <p>This is a reminder that the thesis you borrowed, "<strong>{{ $borrower->thesis_name }}</strong>", is due for return.</p>

    <p>Please return it as soon as possible to avoid any penalties.</p>

    <p>Thank you.</p>

    <p>ThesisTrack</p>
</body>
</html>
