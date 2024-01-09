<!-- resources/views/projects.blade.php -->
<h1>Projects</h1>

<a href="{{ route('projects.create') }}">Create Project</a>

<ul>
    @foreach($projects as $project)
        <li>
            {{ $project->name }}
            <a href="{{ route('projects.show', $project->id) }}">View</a> 
            <a href="{{ route('projects.edit', $project->id) }}">Edit</a> 
            <a href="{{ route('projects.getProjectMembers', $project->id) }}">show Members</a> 
            <form method="POST" action="{{ route('projects.destroy', $project->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this Project?')">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
<a href="{{ route('welcome') }}">Back to home page</a>
