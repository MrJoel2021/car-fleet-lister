<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
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
        // Get items and load their category relationship
        // with('categoryRel') prevents the N+1 query problem
        $items = Item::with('categoryRel')->paginate(5);

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
        // Get the validated form data
        $data = $request->validated();

        // Find or create the category typed in the form
        $category = Category::firstOrCreate([
            'name' => $data['category'],
        ]);

        // Save the category_id relationship
        $data['category_id'] = $category->id;

        // Save the new vehicle
        Item::create($data);

        // Redirect back to the items list with success message
        return redirect()->route('items.index')
            ->with('success', 'Vehicle added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): View
    {
        // Load the related category for this item
        $item->load('categoryRel');

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
        // Get the validated form data
        $data = $request->validated();

        // Find or create the category typed in the form
        $category = Category::firstOrCreate([
            'name' => $data['category'],
        ]);

        // Save the category_id relationship
        $data['category_id'] = $category->id;

        // Update item using validated form data
        $item->update($data);

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
        // Get low stock vehicles and load their category relationship
        $items = Item::with('categoryRel')
            ->where('quantity', '<', $threshold)
            ->orderBy('quantity')
            ->orderBy('product')
            ->paginate(5);

        // Reuse the same index page
        return view('items.index', compact('items'))
            ->with('success', "Showing vehicles with quantity less than {$threshold}");
    }
}