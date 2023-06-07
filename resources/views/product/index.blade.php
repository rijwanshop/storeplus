@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h1 class="fs-4">Product List</h1>
        <a href="{{ route('product.create') }}" class="btn btn-primary">
            Add new product
        </a>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th width="3%" scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Images</th>
                <th scope="col">Categories</th>
                <th width="20%" scope="col">Enable</th>
                <th width="7%" scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($products as $product)
                <tr>
                    <th class="py-3" scope="row">{{ $loop->iteration }}</th>
                    <td class="py-3">{{ $product->name }}</td>
                    <td class="py-3">
                        @foreach ($product->images as $image)
                            <img width="60" src="{{ $image->file }}" alt="">
                        @endforeach
                    </td>
                    <td class="py-3">
                        {{ $product->categories->map(fn($category) => $category->name)->join(', ') }}
                    </td>
                    <td class="py-3">{{ $product->enable ? 'Enable' : 'Disable' }}</td>
                    <td class="gap-3 py-3 d-flex">
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $product->id }}" class="btn btn-sm btn-danger delete-product">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links('pagination::bootstrap-5') }}
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                Are you sure?

                <form action="" method="post">
                    @csrf
                    @method('delete')

                    <input type="hidden" name="product_id">

                    <div class="gap-3 d-flex justify-content-end">
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
            $('.delete-product').on('click', function () {
                const id = $(this).data('id');
                $('input[name="product_id"]').val(id)
            })

            $('form').on('submit', function() {
                event.preventDefault();

                const id = $('input[name="product_id"]').val()
                const formData = new FormData(this)

                let url = `{{ route('api.product.store') }}`
                if(id) {
                    url = `{{ route('api.product.update', ':id') }}`
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
    </script>
@endpush
