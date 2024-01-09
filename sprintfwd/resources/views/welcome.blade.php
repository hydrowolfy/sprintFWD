<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to SprintFWD App</title>
</head>
<body>

    <h1>Welcome to SprintFWD App</h1>

    <p>Explore the following pages:</p>

    <ul>
        <li><a href="{{ route('members.index') }}">Members</a></li>
        <li><a href="{{ route('projects.index') }}">Projects</a></li>
        <li><a href="{{ route('teams.index') }}">Teams</a></li>
    </ul>

</body>
</html>
