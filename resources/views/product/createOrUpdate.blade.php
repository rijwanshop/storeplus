@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="mb-4 d-flex align-items-center justify-content-between">
        <h1 class="fs-4">{{ @$product ? 'Update' : 'Add New' }} Product</h1>
    </div>

    <div class="bg-white">
        <div class="row justify-content-center">
            <div class="p-5 col">
                <form action="" method="post">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ @$product->id }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ @$product->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Image</label>
                        <input type="file" class="form-control" name="file">
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Category</label>
                        <select class="form-select" name="category" id="">
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"  {{ @$product && @$product->categories[0]->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description">{{ @$product->description }}</textarea>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="enable" id="enable" {{ @$product->enable ? 'checked' : '' }}>
                        <label class="form-check-label" for="enable">Enable</label>
                    </div>

                    <button type="submit" class="mt-4 btn btn-primary">Simpan</button>
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
                    location.href = `{{ route('product.table') }}`
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
