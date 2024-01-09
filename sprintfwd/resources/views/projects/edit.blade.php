<!-- resources/views/projects/edit.blade.php -->
<h1>Edit Project</h1>

<form method="POST" action="{{ route('projects.update', $project->id) }}">
    @csrf
    @method('PUT')

    <label for="name">Project Name:</label>
    <input type="text" name="name" value="{{ $project->name }}" required>

    <button type="submit">Update Project</button>
</form>

<a href="{{ route('projects.index') }}">Back to Projects</a>
