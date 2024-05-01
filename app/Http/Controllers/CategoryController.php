<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function anyData(Request $request)
    {
        if ($request->ajax()) {
            $users = Category::select('*');
            return datatables()->of($users)
                ->editColumn('name', function ($users) {
                    return $users->name;
                })->editColumn('description', function ($users) {
                    return $users->description;
                })
                ->addColumn('action', function ($user) {

                    return '<a href="' . route('dashboard.Categories.show', $user->id) . '" class="btn btn-sm btn-clean btn-icon" title="Show"> <i class="la la-eye"></i> </a>
                    <a href="' . route('dashboard.Categories.edit', $user->id) . '" class="btn btn-sm btn-clean btn-icon" title="Edit"> <i class="la la-edit"></i> </a>
                    <a href="' . route('dashboard.Categories.destroy', $user->id) . '" class="btn btn-sm btn-clean btn-icon delete" title="Delete"> <i class="la la-trash"></i> </a>';

                })->addIndexColumn()->rawColumns(['action'])->toJson();
        }


        return view('admin.Category.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        return view('admin.Category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Categories = Category::all();
        $data = [
            "Categories" => $Categories
        ];
        return view('admin.Category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {

        $Category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent,
            'image' => $request->hasFile('image') ? $request->file('image')->store('uploads', 'public') : null,
        ]);
        return redirect()->route('dashboard.Categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Category = Category::FindOrFail($id);

        $data = ['Category' => $Category];
        return view('admin.Category.show', $data);
    }


    public function changeStatus(string $id)
    {

        $Category = Category::find($id);
        $Category->is_active = $Category->is_active ==  1  ? 0 : 1;
        $Category->save();
        return response()->json(['message' => 'Category status updated successfully'], 200);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Categories = Category::all();
        $data = [
            "Categories" => $Categories
        ];
        return view('admin.Category.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryCreateRequest $request, string $id)
    {
        $Category = Category::FindOrFail($id);
        $Category->fill([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent,
            'image' => $request->hasFile('image') ? $request->file('image')->store('uploads', 'public') : null,
        ]);
        $Category->save();
        return redirect()->route('dashboard.Categories.index')->with('Category', 'Admin update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Category::destroy($id);
        return redirect()->route('dashboard.Categories.index')->with('success', 'Category Destroy successfully!');
    }
}
