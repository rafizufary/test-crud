@extends('layouts.layout')

@section('title', 'Home')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tasks</div>
            </div>
            <div class="card-body">
                <a href="/task" class="btn btn-primary btn-round ml-auto">
                    <i class="fa fa-plus"></i>
                    Add Task
                </a>
                <table class="table mt-3 table-bordered">
                <thead>
                    <tr>
                    <th scope="col">No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tasks as $task)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>              
                <td class="text-center">
                    <span 
                        class="
                            @if ($task->status->status === 'Pending') text-danger
                            @elseif ($task->status->status === 'In Progress') text-primary
                            @elseif ($task->status->status === 'Completed') text-success
                            @endif
                        ">
                        {{ $task->status->status }}</td>
                <td class="text-center">
                    <a  href="#" 
                        class="btn btn-sm btn-dark"
                        data-id="{{ $task->id }}"
                        data-title="{{ $task->title }}"
                        data-description="{{ $task->description }}"
                        data-status="{{ $task->status_id }}"
                        >Edit</a>
                    <a  href="#" 
                        class="btn btn-sm btn-danger"
                        data-url="{{ route('task.destroy', $task->id) }}"
                        >Delete</a>
                </td> 
            </tr>
        @empty
            <tr>
                <td colspan="3">No data available</td>
            </tr>
        @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-dark').forEach((button) => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Hentikan aksi default tombol

            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const description = button.getAttribute('data-description');
            const status = button.getAttribute('data-status'); // Ambil status ID

            // SweetAlert untuk form edit
            Swal.fire({
                title: 'Edit Task',
                html: `
                    <div class="form-group">
                        <label for="swal-input-title">Title</label>
                        <input id="swal-input-title" class="form-control" value="${title}">
                    </div>
                    <div class="form-group">
                        <label for="swal-input-description">Description</label>
                        <textarea id="swal-input-description" class="form-control" rows="3">${description}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="swal-input-status">Status</label>
                        <select id="swal-input-status" class="form-control">
                            <option value="1" ${status == 1 ? 'selected' : ''}>Pending</option>
                            <option value="2" ${status == 2 ? 'selected' : ''}>In Progress</option>
                            <option value="3" ${status == 3 ? 'selected' : ''}>Completed</option>
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Save Changes',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    const newTitle = document.getElementById('swal-input-title').value.trim();
                    const newDescription = document.getElementById('swal-input-description').value.trim();
                    const newStatus = document.getElementById('swal-input-status').value;

                    if (!newTitle || !newDescription || !newStatus) {
                        Swal.showValidationMessage('All fields are required');
                        return false;
                    }

                    return {
                        title: newTitle,
                        description: newDescription,
                        status: newStatus,
                    };
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim data ke server
                    fetch(`/task/${id}`, {
                        method: 'POST', // Gunakan PUT jika server mendukung
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            _method: 'PUT', // Laravel membutuhkan method override
                            title: result.value.title,
                            description: result.value.description,
                            status_id: result.value.status, // Status baru
                        }),
                    })
                    .then((response) => {
                        if (response.ok) {
                            Swal.fire('Updated!', 'Task has been updated.', 'success')
                                .then(() => window.location.reload()); // Refresh halaman
                        } else {
                            throw new Error('Failed to update');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error!', 'There was a problem updating the task.', 'error');
                    });
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-danger').forEach((button) => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const url = button.getAttribute('data-url');

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ _method: 'DELETE' }),
                    })
                    .then((response) => {
                        if (response.ok) {
                            Swal.fire("Deleted!", "The task has been deleted.", "success")
                                .then(() => window.location.reload());
                        } else {
                            throw new Error('Failed to delete');
                        }
                    })
                    .catch(() => {
                        Swal.fire("Error!", "There was a problem deleting the task.", "error");
                    });
                }
            });
        });
    });
});
</script>
@endpush