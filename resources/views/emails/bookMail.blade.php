<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Book</title>
</head>
<body>
      <h1>Hi , {{ $auth->name }}</h1>
      <p>Thank you for booking</p>
      <p>Your Book Date : {{ $book->date }} and from {{ $book->start_time }} to {{ $book->end_time }}</p>
      <p>Best regards,<br>Clinic Support</p>
</body>
</html>
