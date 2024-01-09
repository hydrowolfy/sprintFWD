<h1>Edit Member</h1>

<form method="POST" action="{{ route('members.update', $id) }}">
    @csrf
    @method('PUT')
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
