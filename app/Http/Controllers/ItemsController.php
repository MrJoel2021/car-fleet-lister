<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Get items from the database and show 5 per page
        $items = Item::query()->paginate(5);

        // Show resources/views/items/index.blade.php
        return view('items.index', compact('items'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Show resources/views/items/create.blade.php
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemStoreRequest $request): RedirectResponse
    {
        // Save the validated form data
        Item::create($request->validated());

        // Redirect back to the items list with success message
        return redirect()->route('items.index')
            ->with('success', 'Vehicle added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): View
    {
        // Show resources/views/items/show.blade.php
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item): View
    {
        // Show resources/views/items/edit.blade.php
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemUpdateRequest $request, Item $item): RedirectResponse
    {
        // Update item using validated form data
        $item->update($request->validated());

        // Redirect back to the items list with success message
        return redirect()->route('items.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): RedirectResponse
    {
        // Delete the selected item
        $item->delete();

        // Redirect back to the items list with success message
        return redirect()->route('items.index')
            ->with('success', 'Vehicle deleted successfully.');
    }

    /**
     * Show vehicles where quantity is lower than the threshold.
     */
    public function lowStock(int $threshold): View
    {
        // Get vehicles where quantity is less than the threshold
        $items = Item::query()
            ->where('quantity', '<', $threshold)
            ->orderBy('quantity')
            ->orderBy('product')
            ->paginate(5);

        // Reuse the same index page to show the filtered vehicles
        return view('items.index', compact('items'))
            ->with('success', "Showing vehicles with quantity less than {$threshold}");
    }
}