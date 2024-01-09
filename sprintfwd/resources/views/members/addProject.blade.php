<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<h1>add member to Project</h1>
<form method="post" action="{{ route('projects.addMember', ['id' => $id]) }}">
    @csrf
    @method('PUT')

    <label for="project_id">Project:</label>
    <select name="project_id" id="project_id" required>
        @foreach($projects as $project)
            <option value="{{ $project->id }}" selected>
                {{ $project->name }}
                <input type="hidden" name="hidden_project_id" id="hidden_project_id" value="{{ $project->id  }}">
            </option>
        @endforeach
    </select>

    <button type="submit">Update Project</button>
</form>

<script>
    $(document).ready(function () {
        $('#project_id').on('change', function () {
            var selectedProjectId = $(this).val();
            // Update the hidden input field or any other field you want to use
            $('#hidden_project_id').val(selectedProjectId);
        });
    });
</script>


<a href="{{ route('members.index') }}">Back to Members</a>
