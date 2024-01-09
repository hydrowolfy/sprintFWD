<h1>Create Project</h1>

<form method="POST" action="{{ route('projects.store') }}">
    @csrf

    <label for="name">Project Name:</label>
    <input type="text" name="name" required>

    <button type="submit">Create Project</button>
</form>

<a href="{{ route('projects.index') }}">Back to Projects</a>
