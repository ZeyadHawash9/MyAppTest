<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminCreateRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Models\Admin;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{


    public function anyData(Request $request)
    {

        $Admin = Admin::select('*');
        return DataTables::of($Admin)
            ->editColumn('image', function ($Admin) {
                return '<img src="' . $Admin->image . '"  width="80px" height="80px" class="rounded-circle">';
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('dashboard.admins.show', $row->id) . '" class="btn btn-info btn-sm mx-2" ><i class="fa fa-eye"></i></a>';

                $btn .= '<a href="' . Route('dashboard.admins.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';

                $btn .= '    <a  href="' . route('dashboard.admins.destroy', $row) . '" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon delete" title="Delete"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';

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
            })->addIndexColumn()->rawColumns(['action', 'image', 'active'])->toJson();
    }
    public function index()
    {

        // $admins = Admin::all();

        return view(dashboard().'.admins.index');
    }


    public function create()
    {
        return view('dashboard.admins.create');
    }



    public function store(AdminCreateRequest $request)
    {


        Admin::create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $request->hasFile('image') ? $request->file('image')->store('uploads', 'public') : null,
        ]);


        return redirect()->route('dashboard.admins.index')->with('message', 'Admin created successfully!');
    }

    public function changeStatus($id)
    {

        $admin = Admin::FindOrFail(3);
        $admin->is_active = $admin->is_active ==  1  ? 0 : 1;
        $admin->save();
        return response()->json(['message' => 'Admin status updated successfully'], 200);
    }

    public function show(string $id)
    {
        $admin = Admin::FindOrFail($id);

        $data = ['admin' => $admin];
        return view('dashboard.admins.show', $data);
    }


    public function edit(string $id)
    {
        $admin = Admin::FindOrFail($id);

        $data = ['admin' => $admin];
        return view('dashboard.admins.create', $data);
    }

    public function update(AdminUpdateRequest $request, string $id)
    {

        $admin = Admin::FindOrFail($id);
        $admin->fill([
            'name' => $request->input('name'),
            'user_name' => $request->input('user_name'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'image' => $request->hasFile('image') ? $request->file('image')->store('uploads', 'public') : null,
        ]);
        $admin->save();


        return redirect()->route('dashboard.admins.index')->with('message', 'Admin Update successfully!');
    }


    public function destroy(string $id)
    {

        Admin::find($id)->delete();
        return redirect()->route('dashboard.admins.index')->with('success', 'Admin Destroy successfully!');
    }
}
