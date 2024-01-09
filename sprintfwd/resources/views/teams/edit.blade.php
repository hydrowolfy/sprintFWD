<!-- resources/views/teams/edit.blade.php -->
<h1>Edit Team</h1>

<form method="POST" action="{{ route('teams.update', $team->id) }}">
    @csrf
    @method('PUT')

    <label for="name">Team Name:</label>
    <input type="text" name="name" value="{{ $team->name }}" required>

    <button type="submit">Update Team</button>
</form>

<a href="{{ route('teams.index') }}">Back to Teams</a>
