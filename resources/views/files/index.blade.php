@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fs-4">Image List</h1>
        <button type="button" class="btn btn-primary" onclick="editImage()" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add new Image
        </button>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th width="3%" scope="col">#</th>
                <th scope="col">Name</th>
                <th width="20%" scope="col">Enable</th>
                <th width="7%" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($images as $image)
                <tr>
                    <th class="py-3" scope="row">{{ $loop->iteration }}</th>
                    <td class="py-3">{{ $image->name }}</td>
                    <td class="py-3">{{ $image->enable ? 'Enable' : 'Disable' }}</td>
                    <td class="py-3 d-flex gap-3">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="editImage('{{ $image }}')" class="btn btn-sm btn-warning">Edit</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="editImage('{{ $image }}')" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $images->links('pagination::bootstrap-5') }}
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text" id="staticBackdropLabel">Add new Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="post">
                    @csrf

                    <input type="hidden" name="image_id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" name="file">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="enable" id="enable">
                        <label class="form-check-label" for="enable">Enable</label>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text">Add Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                Are you sure?

                <form action="" method="post">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="image_id">

                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes, I'am sure</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('inline-js')
    <script>
        $(document).ready(function() {
            $('form').on('submit', function() {
                event.preventDefault();

                const id = $('input[name="image_id"]').val()
                const formData = new FormData(this)

                let url = `{{ route('api.image.store') }}`
                if(id) {
                    url = `{{ route('api.image.update', ':id') }}`
                    url = url.replace(':id', id)

                    if(formData.get('_method') == null) {
                        formData.append('_method', 'PUT')
                    }
                }

                $.ajax({
                    method: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .done(function(response) {
                    alert(response.message)
                    location.reload()
                })
                .fail(function(error) {
                    const errors = error.responseJSON
                    if(errors) {
                        alert(errors.message)
                    }
                })
            })
        });

        function editImage(data) {
            $('input[name="image_id"]').val('')
            $('input[name="name"]').val('')
            $('input[name="enable"]').removeAttr('checked')
            $('.text').text('Add Image')

            if(data) {
                $('.text').text('Update Image')

                const parseData = JSON.parse(data)
                const id = parseData.id
                const name = parseData.name
                const enable = parseData.enable

                $('input[name="image_id"]').val(id)
                $('input[name="name"]').val(name)

                if(enable == 1) {
                    $('input[name="enable"]').attr('checked', enable)
                }
            }
        }
    </script>
@endpush
