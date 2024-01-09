<!-- resources/views/members.blade.php -->
<h1>Members</h1>

<a href="{{ route('members.create') }}">Create Member</a>

<ul>
    @foreach($members as $member)
        <li>
            {{ $member->first_name }} {{ $member->last_name }}
            ({{ $member->team->name }})
            <a href="{{ route('members.show', $member->id) }}">View</a> 
            <a href="{{ route('members.edit', $member->id) }}">Edit</a> 
            <a href="{{ route('members.updateTeam', $member->id) }}">Update Team</a>
            <a href="{{ route('members.addProject', $member->id) }}">Add To Project</a>

            <form method="POST" action="{{ route('members.destroy', $member->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this member?')">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
<a href="{{ route('welcome') }}">Back to home page</a>
