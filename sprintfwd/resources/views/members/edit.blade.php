<!-- resources/views/members/edit.blade.php -->
<h1>Edit Member</h1>

<form method="POST" action="{{ route('members.update', $member->id) }}">
    @csrf
    @method('PUT')

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="{{ $member->first_name }}" required>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" value="{{ $member->last_name }}" required>

    <label for="city">City:</label>
    <input type="text" name="city" value="{{ $member->city }}">

    <label for="state">State:</label>
    <input type="text" name="state" value="{{ $member->state }}">

    <label for="country">Country:</label>
    <input type="text" name="country" value="{{ $member->country }}">

    <label for="team_id">Team:</label>
    <select name="team_id" required>
        @foreach($teams as $team)
            <option value="{{ $team->id }}" {{ $team->id == $member->team_id ? 'selected' : '' }}>
                {{ $team->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Update Member</button>
</form>

<a href="{{ route('members.index') }}">Back to Members</a>
