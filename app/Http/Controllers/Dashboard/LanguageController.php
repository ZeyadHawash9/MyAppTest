<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\CreateLanguageRequest;
use App\Http\Requests\Language\UpdateLanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class LanguageController extends Controller
{



    public function anyData(Request $request)
    {

        $languages = Language::select('*');
        return DataTables::of($languages)

            ->editColumn('image', function ($languages) {
                return '<img src="' . $languages->image . '"  width="80px" height="80px" class="rounded-circle">';
            })
            ->addColumn('action', function ($Language) {
                $btn = '';
                $btn .= '<a href="' . route('dashboard.languages.show', $Language->id) . '" class="btn btn-info btn-sm mx-2" ><i class="fa fa-eye"></i></a>';

                $btn .= '<a href="' . Route('dashboard.languages.edit', $Language->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';

                $btn .= '    <a  href="' . route('dashboard.languages.destroy', $Language) . '" id="deleteBtn"  data-id="' . $Language->id . '" class="btn btn-sm btn-clean btn-icon delete" title="Delete"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';

                return $btn;
            })
            ->addColumn('active', function ($Language) {

                return '
                <div class="col-md-9">
                    <div class="form-check form-switch form-check-custom form-check-solid me-10">
                        <form target="_self" id="FormToggleSubmit" class="FormToggleSubmit container max-w-3xl mx-auto" enctype="multipart/form-data">
                            <input type="hidden" name="url" value="' . route('dashboard.languages.status', $Language) . '">
                            <input type="hidden" name="id" value="' . $Language->id . '">

                            <input class="form-check-input h-30px w-50px make-switch active" name="autotimezone" type="checkbox" value=""
                            data-id="' . $Language->id . '"       id="autotimezone" ' . ($Language->is_active == 1 ? 'checked' : '') . ' >
                        </form>
                    </div>
                </div>';
            })->addIndexColumn()->rawColumns(['action', 'image', 'active'])->toJson();
    }
    public function index()
    {

        $links = [
            '#' => __('dashboard.languages'),
            route('dashboard.languages.index') => __('dashboard.languages list'),
        ];

        $data = [
            'page_title' => __('dashboard.languages list'),
            'links' => $links
        ];
        return view(dashboard() . '.languages.index', $data);
    }


    public function create()
    {

        $links = [
            '#' => __('dashboard.languages'),
            route('dashboard.languages.index') => __('dashboard.languages list'),
            route('dashboard.languages.create') => __('dashboard.languages create'),

        ];

        $data = [
            'page_title' => __('dashboard.languages create'),
            'links' => $links
        ];
        return view(dashboard() . '.languages.create', $data);
    }



    public function store(CreateLanguageRequest $request)
    {

        $Language = new Language();
        $Language->name = $request->name;
        $Language->iso = $request->iso;
        $Language->dir = $request->dir;
        $Language->image = isset($request->image) ? storePhoto('languages', $request->image) : '';
        $Language->save();



        return redirect()->route(dashboard() . '.languages.index')->with('message', __('language created successfully!'));
    }

    public function changeStatus($id)
    {
        $Language = Language::FindOrFail($id);
        $Language->is_active = !($Language->is_active);
        $Language->save();
        return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('Language status updated successfully')]);
    }

    public function show(string $id)
    {
        $Language = Language::FindOrFail($id);
        $links = [
            '#' => __('dashboard.admins'),
            route('dashboard.languages.index') => __('dashboard.admins list'),
            route('dashboard.languages.show', $Language) => __('dashboard.admins show'),

        ];

        $data = [
            'page_title' => __('dashboard.admins show'),
            'links' => $links,
            'Language' => $Language
        ];
        return view(dashboard() . '.languages.show', $data);
    }


    public function edit(string $id)
    {
        $Language = Language::FindOrFail($id);
        $links = [
            '#' => __('dashboard.admins'),
            route('dashboard.languages.index') => __('dashboard.admins list'),
            route('dashboard.languages.edit', $Language) => __('dashboard.admins edit'),

        ];

        $data = [
            'page_title' => __('dashboard.admins edit'),
            'links' => $links,
            'Language' => $Language
        ];
        return view(dashboard() . '.languages.create', $data);
    }

    public function update(UpdateLanguageRequest $request, string $id)
    {

        $Language = Language::findOrFail($id);
        $Language->name = $request->filled('name') ? $request->name : $Language->name;
        $Language->iso = $request->input('iso', $Language->iso);
        $Language->dir = $request->input('dir', $Language->dir);
        $Language->image = $request->hasFile('image') ? storePhoto('Languages', $request->file('image')) : $Language->image;
        $Language->save();

        return redirect()->route(dashboard() . '.languages.index')->with('message', __('Language Update successfully!'));
    }


    public function destroy(string $id)
    {

        Language::FindOrFail($id)->delete();
        return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('Language Destroy successfully!')]);
    }
}
