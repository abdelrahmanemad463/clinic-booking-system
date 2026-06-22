<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Book</title>
</head>
<body>
      <h1>Hi , {{ $doctor->name }}</h1>
      <p>You Have a new book</p>
      <p>Book Date : {{ $book->date }} and from {{ $book->start_time }} to {{ $book->end_time }}</p>
      <p>Patient Name : <b>{{ $auth->name }}</b></p>

      <p>Best regards,<br>Clinic Support</p>
</body>
</html>
