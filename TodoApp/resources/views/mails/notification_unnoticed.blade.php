<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $task->title }} has been unnoticed</title>
</head>
<body>
<h1>Task Unnoticed</h1>

<p>Hello,</p>

<p>This is a reminder that you still have to complete <strong>{{ $task->title }}</strong>, you may want to take it</p>

<p><strong>Description:</strong> {{ $task->body }}</p>

<p><strong>Importance:</strong> {{ $task->priopity }}</p>

<p>Please make sure to take proper measures!</p>

<p>Best regards,<br>TodoApp Team</p>
</body>
</html>
