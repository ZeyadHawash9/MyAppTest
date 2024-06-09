<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Models\Language;
use App\Repositories\Eloquent\PermissionEloquent;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    private $Permission;
    public function __construct(PermissionEloquent $PermissionEloquent)
    {
        $this->Permission = $PermissionEloquent;
    }

    public function anyData()
    {
        return $this->Permission->anyData();
    }
    public function index()
    {

        $links = [
            '#' => __('dashboard.permissions'),
            route('dashboard.permissions.index') => __('dashboard.permissions list'),
        ];

        $data = [
            'page_title' => __('dashboard.permissions list'),
            'links' => $links
        ];
        return view(dashboard() . '.permissions.index', $data);
    }
    public function create()
    {

        $links = [
            '#' => __('dashboard.permissions'),
            route('dashboard.permissions.index') => __('dashboard.permissions list'),
            route('dashboard.permissions.create') => __('dashboard.permissions create'),

        ];

        $data = [
            'page_title' => __('dashboard.permissions create'),
            'links' => $links,
        ];
        return view(dashboard() . '.permissions.create', $data);
    }

    public function store(CreatePermissionRequest $request)
    {
        return $this->Permission->create($request->all());

    }
    public function changeStatus(Permission $permission)
    {

        return $this->Permission->changeStatus($permission->id);
    }


    public function show(Permission $permission)
    {
        $links = [
            '#' => __('dashboard.permissions'),
            route('dashboard.permissions.index') => __('dashboard.permissions list'),
            route('dashboard.permissions.show', $permission) => __('dashboard.permissions show'),

        ];

        $data = [
            'page_title' => __('dashboard.permissions show'),
            'links' => $links,
            'permission' => $permission,

        ];
        return view(dashboard() . '.permissions.show', $data);
    }

    public function edit(Permission $permission)
    {

        $links = [
            '#' => __('dashboard.permissions'),
            route('dashboard.permissions.index') => __('dashboard.permissions list'),
            route('dashboard.permissions.edit', $permission) => __('dashboard.permissions edit'),

        ];

        $data = [
            'page_title' => __('dashboard.permissions edit'),
            'links' => $links,
            'permission' => $permission,
        ];
        return view(dashboard() . '.permissions.create', $data);
    }


    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        return $this->Permission->update($request->all(),$permission->id);


    }

    public function destroy(Permission $permission)
    {
        return $this->Permission->delete($permission->id);
    }
}
