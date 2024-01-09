<!-- resources/views/teams/create.blade.php -->
<h1>Create Team</h1>

<form method="POST" action="{{ route('teams.store') }}">
    @csrf

    <label for="name">Team Name:</label>
    <input type="text" name="name" required>

    <button type="submit">Create Team</button>
</form>

<a href="{{ route('teams.index') }}">Back to Teams</a>
