<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $task->title }} - Reminder</title>
</head>
<body>
<h1>Task Reminder</h1>

<p>Hello,</p>

<p>This is a reminder that your task <strong>{{ $task->title }}</strong> is due in 1 day.</p>

<p><strong>Description:</strong> {{ $task->body }}</p>

<p><strong>Due Date:</strong> {{ $task->deadline->format('F d, Y') }}</p>

<p>Please make sure to complete it before the due date!</p>

<p>Best regards,<br>TodoApp Team</p>
</body>
</html>
