<!-- resources/views/projects.blade.php -->
<h1>Projects</h1>

<a href="{{ route('projects.create') }}">Create Project</a>

<ul>
    @foreach($projects as $project)
        <li>
            {{ $project->name }}
            <a href="{{ route('projects.show', $project->id) }}">View</a>
            <a href="{{ route('projects.edit', $project->id) }}">Edit</a>
        </li>
    @endforeach
</ul>