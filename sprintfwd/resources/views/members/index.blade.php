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
        </li>
    @endforeach
</ul>
