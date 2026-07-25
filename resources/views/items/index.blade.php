@extends('items.layout')

@section('content')

<div class="card mt-5">
    {{-- Page heading --}}
    <h2 class="card-header">Car Fleet Listing</h2>

    <div class="card-body">

        {{-- Show success message after create, update, delete, or low stock filter --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Page action buttons --}}
        <div class="d-flex justify-content-end mb-3 gap-2">

            {{-- Show vehicles where quantity is less than 5 --}}
            <a class="btn btn-warning btn-sm" href="{{ route('items.lowstock', 5) }}">
                Low Stock
            </a>

            {{-- Show all vehicles again --}}
            <a class="btn btn-secondary btn-sm" href="{{ route('items.index') }}">
                All Vehicles
            </a>

            {{-- Add new vehicle button --}}
            <a class="btn btn-success btn-sm" href="{{ route('items.create') }}">
                <i class="fa fa-plus"></i> Add New Vehicle
            </a>

        </div>

        {{-- Vehicles table --}}
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price (per day)</th>
                    <th width="220px">Action</th>
                </tr>
            </thead>

            <tbody>
                {{-- Loop through all vehicles --}}
                @forelse ($items as $item)
                    <tr>
                        {{-- Vehicle product/name --}}
                        <td>{{ $item->product }}</td>

                        {{-- Vehicle category --}}
                        <td>{{ $item->category }}</td>

                        {{-- Vehicle quantity --}}
                        <td>{{ $item->quantity }}</td>

                        {{-- Vehicle price per day --}}
                        <td>{{ $item->price }}</td>

                        {{-- Action buttons --}}
                        <td>
                            {{-- Show one vehicle --}}
                            <a class="btn btn-info btn-sm" href="{{ route('items.show', $item) }}">
                                Show
                            </a>

                            {{-- Edit vehicle --}}
                            <a class="btn btn-primary btn-sm" href="{{ route('items.edit', $item) }}">
                                Edit
                            </a>

                            {{-- Delete vehicle --}}
                            <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                {{-- Delete button with confirmation --}}
                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this vehicle?')"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    {{-- Show this if there are no vehicles --}}
                    <tr>
                        <td colspan="5">There are no data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination links --}}
        {!! $items->links() !!}

    </div>
</div>

@endsection