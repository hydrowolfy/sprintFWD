<!-- resources/views/teams.blade.php -->
<h1>Teams</h1>

<a href="{{ route('teams.create') }}">Create Team</a>

<ul>
    @foreach($teams as $team)
        <li>
            {{ $team->name }}
            <a href="{{ route('teams.show', $team->id) }}">View</a>
            <a href="{{ route('teams.edit', $team->id) }}">Edit</a>
            <a href="{{ route('teams.getTeamMembers', $team->id) }}">View Team Members</a>

            <form method="POST" action="{{ route('teams.destroy', $team->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this team?')">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
<a href="{{ route('welcome') }}">Back to home page</a>
