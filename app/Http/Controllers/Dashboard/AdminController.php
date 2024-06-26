<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminCreateRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Yajra\DataTables\Facades\DataTables;
use \Illuminate\Support\Str;
use App\Models\Role;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:index brand')->only('index');
        $this->middleware('permission:create brand')->only('create');
        $this->middleware('permission:show brand')->only('show');
        $this->middleware('permission:update brand')->only(['update', 'changeStatus']);
        $this->middleware('permission:delete brand')->only('destroy');
    }


    public function anyData(Request $request)
    {

        $Admin = Admin::select('*');
        return DataTables::of($Admin)

            ->editColumn('image', function ($Admin) {
                return '<img src="' . $Admin->image . '"  width="80px" height="80px" class="rounded-circle">';
            })
            ->addColumn('role', function ($Admin) {
                $roles = $Admin->getRoleNames();
                $RoleNames = '';
                foreach ($roles as  $role) {
                    $RoleNames .= '<p>' . $role . '</p>';
                }
                return $RoleNames;
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
                    <div class="form-check form-switch form-check-custom form-check-solid ">
                        <form target="_self" id="FormToggleSubmit" class="FormToggleSubmit container max-w-3xl mx-auto" enctype="multipart/form-data">
                            <input type="hidden" name="url" value="' . route('dashboard.admins.status', $row) . '">
                            <input type="hidden" name="id" value="' . $row->id . '">

                            <input class="form-check-input h-30px w-50px make-switch active" name="autotimezone" type="checkbox" value=""
                            data-id="' . $row->id . '"       id="autotimezone" ' . ($row->is_active == 1 ? 'checked' : '') . ' >
                        </form>
                    </div>
                </div>';
            })->addIndexColumn()->rawColumns(['action', 'image', 'active', 'role'])->toJson();
    }
    public function index()
    {

        $links = [
            '#' => __('dashboard.admins'),
            route('dashboard.admins.index') => __('dashboard.admins list'),
        ];

        $data = [
            'page_title' => __('dashboard.admins list'),
            'links' => $links
        ];
        return view(dashboard() . '.admins.index', $data);
    }


    public function create()
    {

        $roles = Role::all();
        $links = [
            '#' => __('dashboard.admins'),
            route('dashboard.admins.index') => __('dashboard.admins list'),
            route('dashboard.admins.create') => __('dashboard.admins create'),

        ];

        $data = [
            'page_title' => __('dashboard.admins create'),
            'links' => $links,
            'roles' => $roles

        ];
        return view(dashboard() . '.admins.create', $data);
    }



    public function store(AdminCreateRequest $request)
    {

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->user_name = $request->user_name;
        $admin->phone_number = $request->phone_number;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->image = isset($request->image) ? storePhoto('admins', $request->image) : '';
        $admin->save();
        $admin->assignRole($request->roles);




        return redirect()->route(dashboard() . '.admins.index')->with('message', __('Admin created successfully!'));
    }

    public function changeStatus(Admin $admin)
    {
        $admin->is_active = !($admin->is_active);
        $admin->save();
        return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('Admin status updated successfully')]);
    }

    public function show(Admin $admin)
    {

        $links = [
            '#' => __('dashboard.admins'),
            route('dashboard.admins.index') => __('dashboard.admins list'),
            route('dashboard.admins.show', $admin) => __('dashboard.admins show'),

        ];

        $data = [
            'page_title' => __('dashboard.admins show'),
            'links' => $links,
            'admin' => $admin
        ];
        return view(dashboard() . '.admins.show', $data);
    }


    public function edit(Admin $admin)
    {
        $roles = Role::all();
        $adminRoles = $admin->getRoleNames();


        $links = [
            '#' => __('dashboard.admins'),
            route('dashboard.admins.index') => __('dashboard.admins list'),
            route('dashboard.admins.edit', $admin) => __('dashboard.admins edit'),

        ];

        $data = [
            'page_title' => __('dashboard.admins edit'),
            'links' => $links,
            'admin' => $admin,
            'roles' => $roles,
            'adminRoles' => $adminRoles,
        ];
        return view(dashboard() . '.admins.create', $data);
    }

    public function update(AdminUpdateRequest $request, Admin $admin)
    {



        $admin->name = $request->filled('name') ? $request->name : $admin->name;
        $admin->user_name = $request->input('user_name', $admin->user_name);
        $admin->phone_number = $request->input('phone_number', $admin->phone_number);
        $admin->email = $request->input('email', $admin->email);
        $admin->password = $request->filled('password') ? bcrypt($request->password) : $admin->password;
        $admin->image = $request->hasFile('image') ? storePhoto('admins', $request->file('image')) : $admin->image;
        $admin->syncRoles($request->roles);
        $admin->save();


        return redirect()->route(dashboard() . '.admins.index')->with('message', __('Admin Update successfully!'));
    }


    public function destroy(Admin $admin)
    {

        $admin->delete();
        return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('Admin Destroy successfully!')]);
    }
}
