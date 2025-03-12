<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $task->title }} - Failed</title>
</head>
<body>
<h1>Task Failed</h1>

<p>Hello,</p>

<p>This is a reminder that you have failed to complete <strong>{{ $task->title }}</strong>, you may want to rearrange it to another date</p>

<p><strong>Description:</strong> {{ $task->body }}</p>

<p><strong>Importance:</strong> {{ $task->priopity }}</p>

<p>Please make sure to take proper measures!</p>

<p>Best regards,<br>TodoApp Team</p>
</body>
</html>
