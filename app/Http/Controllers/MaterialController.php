<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isHR()) {
            $materials = Material::with(['category', 'departments'])->where('archived', false)->get();
        } else {
            $materials = Material::with(['category', 'departments'])
                ->whereHas('departments', function($query) use ($user) {
                    $query->where('department_id', $user->department_id);
                })
                ->where('archived', false)
                ->get();
        }
        
        return view('hr.index', compact('materials'));
    }

    public function create()
    {
        $categories = MaterialCategory::all();
        $departments = Department::all();
        return view('materials.create', compact('categories', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:tbl_material_categories,id',
            'departments' => 'required|array',
            'departments.*' => 'exists:tbl_departments,id',
            'file' => 'nullable|file|max:10240',
            'link' => 'nullable|url'
        ]);

        $material = new Material($request->except('departments'));
        
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('materials');
            $material->file_path = $path;
        }

        $material->created_by = auth()->id();
        $material->uploaded_by = auth()->id();
        $material->save();

        $material->departments()->sync($request->departments);

        return redirect()->route('hr.index')->with('success', 'Material created successfully');
    }

    public function edit(Material $material)
    {
        $categories = MaterialCategory::all();
        $departments = Department::all();
        return view('materials.edit', compact('material', 'categories', 'departments'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:tbl_material_categories,id',
            'departments' => 'required|array',
            'departments.*' => 'exists:tbl_departments,id',
            'file' => 'nullable|file|max:10240',
            'link' => 'nullable|url'
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($material->file_path) {
                Storage::delete($material->file_path);
            }
            $path = $request->file('file')->store('materials');
            $material->file_path = $path;
        }

        $material->update($request->except(['file', 'departments']));
        $material->departments()->sync($request->departments);
        $material->updated_by = auth()->id();
        $material->save();

        return redirect()->route('hr.index')->with('success', 'Material updated successfully');
    }

    public function show(Material $material)
    {
        // Increment view count
        $material->increment('views');

        // Load relationships
        $material->load(['category', 'departments', 'uploader']);

        return view('materials.show', compact('material'));
    }

    public function download(Material $material)
    {
        // Check if user has access to this material
        if (!auth()->user()->canAccessMaterial($material)) {
            return redirect()->back()->with('error', 'You do not have permission to download this file.');
        }

        // Check if file exists
        if (!$material->file_path || !Storage::exists($material->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // Get original filename from storage path
        $originalName = basename($material->file_path);

        // Return file download response
        return Storage::download($material->file_path, $originalName);
    }

    public function destroy(Material $material)
    {
        // Delete the associated file if it exists
        if ($material->file_path && Storage::exists($material->file_path)) {
            Storage::delete($material->file_path);
        }

        // Remove department associations
        $material->departments()->detach();

        // Soft delete or permanently delete the material
        $material->archived = true;
        $material->save();

        return redirect()->route('hr.index')->with('success', 'Material deleted successfully');
    }
}