<!-- resources/views/members/create.blade.php -->
<h1>Create Member</h1>

<form method="POST" action="{{ route('members.store') }}">
    @csrf

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required>

    <label for="city">City:</label>
    <input type="text" name="city">

    <label for="state">State:</label>
    <input type="text" name="state">

    <label for="country">Country:</label>
    <input type="text" name="country">

    <label for="team_id">Team:</label>
    <select name="team_id" required>
        @foreach($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
        @endforeach
    </select>

    <button type="submit">Create Member</button>
</form>

<a href="{{ route('members.index') }}">Back to Members</a>
