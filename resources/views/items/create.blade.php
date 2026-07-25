@extends('items.layout')

@section('content')

<div class="card mt-5">
    {{-- Page heading --}}
    <h2 class="card-header">Add New Vehicle</h2>

    <div class="card-body">

        {{-- Back button --}}
        <div class="mb-3 text-end">
            <a class="btn btn-primary btn-sm" href="{{ route('items.index') }}">
                Back
            </a>
        </div>

        {{-- Create vehicle form --}}
        <form action="{{ route('items.store') }}" method="POST">
            {{-- Laravel security token --}}
            @csrf

            {{-- Product input --}}
            <div class="mb-3">
                <label class="form-label">
                    <strong>Product:</strong>
                </label>

                <input
                    type="text"
                    name="product"
                    class="form-control @error('product') is-invalid @enderror"
                    value="{{ old('product') }}"
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
                    class="form-control @error('category') is-invalid @enderror"
                    value="{{ old('category') }}"
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
                    class="form-control @error('quantity') is-invalid @enderror"
                    value="{{ old('quantity') }}"
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
                    class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price') }}"
                >

                @error('price')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Submit button --}}
            <button type="submit" class="btn btn-success">
                Submit
            </button>
        </form>

    </div>
</div>

@endsection