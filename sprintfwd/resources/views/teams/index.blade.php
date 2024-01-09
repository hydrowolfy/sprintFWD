<!-- resources/views/teams.blade.php -->
<h1>Teams</h1>

<a href="{{ route('teams.create') }}">Create Team</a>

<ul>
    @foreach($teams as $team)
        <li>
            {{ $team->name }}
            <a href="{{ route('teams.show', $team->id) }}">View</a>
            <a href="{{ route('teams.edit', $team->id) }}">Edit</a>
        </li>
    @endforeach
</ul>
