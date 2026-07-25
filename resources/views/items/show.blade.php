@extends('items.layout')

@section('content')

<div class="card mt-5">
    {{-- Page heading --}}
    <h2 class="card-header">Show Vehicle</h2>

    <div class="card-body">

        {{-- Back button --}}
        <div class="mb-3 text-end">
            <a class="btn btn-primary btn-sm" href="{{ route('items.index') }}">
                Back
            </a>
        </div>

        {{-- Vehicle details --}}
        <div class="row">
            <div class="col-md-12 mb-2">
                <strong>Product:</strong> {{ $item->product }}
            </div>

            <div class="col-md-12 mb-2">
                <strong>Category:</strong> {{ $item->category }}
            </div>

            <div class="col-md-12 mb-2">
                <strong>Quantity:</strong> {{ $item->quantity }}
            </div>

            <div class="col-md-12 mb-2">
                <strong>Price per day:</strong> {{ $item->price }}
            </div>
        </div>

    </div>
</div>

@endsection