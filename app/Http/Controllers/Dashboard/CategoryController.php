<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Models\Category;

class CategoryController extends Controller
{

    public function anyData(Request $request)
    {
        if ($request->ajax()) {
            $Category = Category::select('*');
            return datatables()->of($Category)
                ->editColumn('name', function ($Category) {
                    return $Category->name;
                })->editColumn('description', function ($Category) {
                    return $Category->description;
                })
                ->editColumn('image', function ($Category) {
                    return '<img src="' . $Category->image . '"  width="80px" height="80px" class="rounded-circle">';
                })
                ->addColumn('parent', function ($Category) {
                    return $Category->parent;
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<a href="' . route('dashboard.categories.show', $row->id) . '" class="btn btn-info btn-sm mx-2" ><i class="fa fa-eye"></i></a>';

                    $btn .= '<a href="' . Route('dashboard.categories.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';

                    $btn .= '    <a  href="' . route('dashboard.categories.destroy', $row) . '" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon delete" title="Delete"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';

                    return $btn;
                })
                ->addColumn('active', function ($row) {

                    return '
                    <div class="col-md-9">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <form target="_self" id="FormToggleSubmit" class="FormToggleSubmit container max-w-3xl mx-auto" enctype="multipart/form-data">
                                <input type="hidden" name="url" value="' . route('dashboard.admins.status', $row) . '">
                                <input type="hidden" name="id" value="' . $row->id . '">

                                <input class="form-check-input h-30px w-50px" name="autotimezone" type="checkbox" value=""
                                    id="autotimezone" ' . ($row->is_active == 1 ? 'checked' : '') . ' >
                            </form>
                        </div>
                    </div>';
                })->addIndexColumn()->rawColumns(['action','active','image'])->toJson();
        }


        return view('dashboard.Category.index');
    }

    public function index()
    {



        return view('dashboard.Category.index');
    }


    public function create()
    {
        $Categories = Category::all();
        $data = [
            "Categories" => $Categories
        ];
        return view('dashboard.Category.create', $data);
    }


    public function store(CategoryCreateRequest $request)
    {

        $Category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent,
            'image' => $request->hasFile('image') ? $request->file('image')->store('uploads', 'public') : null,
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully!');
    }


    public function show(string $id)
    {
        $Category = Category::FindOrFail($id);

        $data = ['Category' => $Category];
        return view('dashboard.Category.show', $data);
    }


    public function changeStatus(string $id)
    {

        $Category = Category::find($id);
        $Category->is_active = $Category->is_active ==  1  ? 0 : 1;
        $Category->save();
        return response()->json(['message' => 'Category status updated successfully'], 200);
    }

    public function edit(string $id)
    {
        $Categories = Category::all();

        $Category = Category::FindOrFail($id);
        $data = [
            "Categories"=>$Categories,
            "Category" => $Category
        ];
        return view('dashboard.Category.create', $data);
    }


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


    public function destroy(string $id)
    {

        Category::destroy($id);
        return redirect()->route('dashboard.Categories.index')->with('success', 'Category Destroy successfully!');
    }
}
