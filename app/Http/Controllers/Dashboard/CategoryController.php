<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Language;
use Yajra\DataTables\Facades\DataTables;

//v category   r categories
class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:index category')->only('index');
        $this->middleware('permission:create category')->only('create');
        $this->middleware('permission:show category')->only('show');
        $this->middleware('permission:update category')->only(['update', 'changeStatus']);
        $this->middleware('permission:delete category')->only('destroy');
    }

    public function anyData(Request $request)
    {


        $Category = Category::select('*');
        return DataTables::of($Category)
            ->editColumn('name', function ($Category) {
                return $Category->name;
            })->editColumn('description', function ($Category) {
                return $Category->description;
            })
            ->addColumn('parent', function ($Category) {
                return $Category->parent?->name;
            })

            ->editColumn('image', function ($Category) {
                return '<img src="' . $Category->image . '"  width="80px" height="80px" class="rounded-circle">';
            })
            ->addColumn('action', function ($category) {
                $btn = '';
                $btn .= '<a href="' . route('dashboard.categories.show', $category->id) . '" class="btn btn-info btn-sm mx-2" ><i class="fa fa-eye"></i></a>';

                $btn .= '<a href="' . Route('dashboard.categories.edit', $category->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';

                $btn .= '    <a  href="' . route('dashboard.categories.destroy', $category) . '" id="deleteBtn"  data-id="' . $category->id . '" class="btn btn-sm btn-clean btn-icon delete" title="Delete"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';

                return $btn;
            })
            ->addColumn('active', function ($Category) {

                return '
                <div class="col-md-9">
                    <div class="form-check form-switch form-check-custom form-check-solid  ">
                        <form target="_self" id="FormToggleSubmit" class="FormToggleSubmit container max-w-3xl mx-auto" enctype="multipart/form-data">
                            <input type="hidden" name="url" value="' . route('dashboard.categories.status', $Category) . '">
                            <input type="hidden" name="id" value="' . $Category->id . '">

                            <input class="form-check-input h-30px w-50px make-switch active" name="autotimezone" type="checkbox" value=""
                            data-id="' . $Category->id . '"       id="autotimezone" ' . ($Category->is_active == 1 ? 'checked' : '') . ' >
                        </form>
                    </div>
                </div>';
            })->addIndexColumn()->rawColumns(['action', 'image', 'active'])->toJson();
    }
    public function index()
    {

        $links = [
            '#' => __('dashboard.categories'),
            route('dashboard.categories.index') => __('dashboard.categories list'),
        ];

        $data = [
            'page_title' => __('dashboard.categories list'),
            'links' => $links
        ];
        return view(dashboard() . '.categories.index', $data);
    }


    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $languages = Language::all();


        $links = [
            '#' => __('dashboard.categories'),
            route('dashboard.categories.index') => __('dashboard.categories list'),
            route('dashboard.categories.create') => __('dashboard.categories create'),

        ];

        $data = [
            'page_title' => __('dashboard.categories create'),
            'links' => $links,
            'categories' => $categories,
            'languages' => $languages,

        ];
        return view(dashboard() . '.categories.create', $data);
    }



    public function store(CreateCategoryRequest $request)
    {
        $category = new category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id  = $request->parent;
        $category->image = isset($request->image) ? storePhoto('categories', $request->image) : '';
        $category->save();


        return redirect()->route(dashboard() . '.categories.index')->with('message', __('category created successfully!'));
    }

    public function changeStatus(Category $category)
    {
        $category->is_active = !($category->is_active);
        $category->save();
        return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('Category status updated successfully')]);
    }

    public function show(Category $category)
    {
        $links = [
            '#' => __('dashboard.categories'),
            route('dashboard.categories.index') => __('dashboard.categories list'),
            route('dashboard.categories.show', $category) => __('dashboard.categories show'),

        ];

        $data = [
            'page_title' => __('dashboard.categories show'),
            'links' => $links,
            'category' => $category
        ];
        return view(dashboard() . '.categories.show', $data);
    }


    public function edit(Category $category)
    {

        $categories = Category::all();
        $languages = Language::all();


        $links = [
            '#' => __('dashboard.categories'),
            route('dashboard.categories.index') => __('dashboard.categories list'),
            route('dashboard.categories.edit', $category) => __('dashboard.categories edit'),

        ];

        $data = [
            'page_title' => __('dashboard.categories edit'),
            'links' => $links,
            'category' => $category,
            'categories' => $categories,
            'languages' => $languages,
        ];
        return view(dashboard() . '.categories.create', $data);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {



        $category->name = $request->filled('name') ? $request->name : $category->name;
        $category->description = $request->input('description', $category->description);
        $category->parent_id = $request->input('parent_id', $category->parent_id);
        $category->image = $request->hasFile('image') ? storePhoto('categories', $request->file('image')) : $category->image;
        $category->save();


        return redirect()->route(dashboard() . '.categories.index')->with('message', __('Category Update successfully!'));
    }


    public function destroy(Category $category)
    {

        $category->delete();
        return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('category Destroy successfully!')]);
    }
}
