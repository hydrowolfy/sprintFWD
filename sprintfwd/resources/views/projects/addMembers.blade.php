<h1>add member to Project</h1>

<form method="POST" action="{{ route('projects.addMember', $id) }}">
    @csrf
    @method('PUT')
    <label for="member_id">Member:</label>
    <select name="member_id" required>
        @foreach($members as $member)
            <option value="{{ $member->id }}" {{ $project->id == $member->team_id ? 'selected' : '' }}>
                {{ $member->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Update Project</button>
</form>
