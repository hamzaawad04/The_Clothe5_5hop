<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of the categories
    public function index()
    {
        // Fetch all categories from the database
        $categories = Category::all();
        return view('categories.index', compact('categories')); // Pass categories to the view
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('categories.create'); // Return the form view for creating a category
    }

    // Store a newly created category in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',  // Ensure the 'name' is unique
        ]);

        // Create the category in the database
        Category::create([
            'name' => $request->name,  // Save the category name
        ]);

        // Redirect back to the categories list with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    // Display the specified category
    public function show($id)
    {
        $category = Category::findOrFail($id);  // Find category by id or fail
        return view('categories.show', compact('category')); // Pass category to the view
    }

    // Show the form for editing the specified category
    public function edit($id)
    {
        $category = Category::findOrFail($id);  // Find category by id or fail
        return view('categories.edit', compact('category'));  // Pass the category to the edit form view
    }

    // Update the specified category in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,  // Ensure name is unique except for the current category
        ]);

        $category = Category::findOrFail($id);  // Find category by id or fail
        $category->update([
            'name' => $request->name,  // Update the category's name
        ]);

        // Redirect to categories index with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Remove the specified category from the database
    public function destroy($id)
    {
        $category = Category::findOrFail($id);  // Find category by id or fail
        $category->delete();  // Delete the category

        // Redirect to categories index with a success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}