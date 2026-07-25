@extends('items.layout')

@section('content')

<div class="card mt-5">
    {{-- Page heading --}}
    <h2 class="card-header">Edit Vehicle</h2>

    <div class="card-body">

        {{-- Back button --}}
        <div class="mb-3 text-end">
            <a class="btn btn-primary btn-sm" href="{{ route('items.index') }}">
                Back
            </a>
        </div>

        {{-- Edit vehicle form --}}
        <form action="{{ route('items.update', $item) }}" method="POST">
            {{-- Laravel security token --}}
            @csrf

            {{-- Laravel method spoofing for update --}}
            @method('PUT')

            {{-- Product input --}}
            <div class="mb-3">
                <label class="form-label">
                    <strong>Product:</strong>
                </label>

                <input
                    type="text"
                    name="product"
                    value="{{ old('product', $item->product) }}"
                    class="form-control @error('product') is-invalid @enderror"
                >

                @error('product')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Category input --}}
            <div class="mb-3">
                <label class="form-label">
                    <strong>Category:</strong>
                </label>

                <input
                    type="text"
                    name="category"
                    value="{{ old('category', $item->category) }}"
                    class="form-control @error('category') is-invalid @enderror"
                >

                @error('category')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Quantity input --}}
            <div class="mb-3">
                <label class="form-label">
                    <strong>Quantity:</strong>
                </label>

                <input
                    type="number"
                    name="quantity"
                    value="{{ old('quantity', $item->quantity) }}"
                    class="form-control @error('quantity') is-invalid @enderror"
                >

                @error('quantity')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Price input --}}
            <div class="mb-3">
                <label class="form-label">
                    <strong>Price:</strong>
                </label>

                <input
                    type="number"
                    name="price"
                    value="{{ old('price', $item->price) }}"
                    class="form-control @error('price') is-invalid @enderror"
                >

                @error('price')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Update button --}}
            <button type="submit" class="btn btn-success">
                Update
            </button>
        </form>

    </div>
</div>

@endsection