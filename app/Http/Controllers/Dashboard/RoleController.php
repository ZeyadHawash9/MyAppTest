<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Models\Language;
use App\Repositories\Eloquent\RoleEloquent;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    private $role;
    public function __construct(RoleEloquent $RoleEloquent)
    {
        $this->role = $RoleEloquent;
    }

    public function anyData()
    {
        return $this->role->anyData();
    }
    public function index()
    {

        $links = [
            '#' => __('dashboard.roles'),
            route('dashboard.roles.index') => __('dashboard.roles list'),
        ];

        $data = [
            'page_title' => __('dashboard.roles list'),
            'links' => $links
        ];
        return view(dashboard() . '.roles.index', $data);
    }
    public function create()
    {

        $links = [
            '#' => __('dashboard.roles'),
            route('dashboard.roles.index') => __('dashboard.roles list'),
            route('dashboard.roles.create') => __('dashboard.roles create'),

        ];

        $data = [
            'page_title' => __('dashboard.roles create'),
            'links' => $links,
        ];
        return view(dashboard() . '.roles.create', $data);
    }

    public function store(CreateRoleRequest $request)
    {
        return $this->role->create($request->all());

    }
    public function changeStatus(Role $role)
    {

        return $this->role->changeStatus($role->id);
    }


    public function show(Role $role)
    {
        $links = [
            '#' => __('dashboard.roles'),
            route('dashboard.roles.index') => __('dashboard.roles list'),
            route('dashboard.roles.show', $role) => __('dashboard.roles show'),

        ];

        $data = [
            'page_title' => __('dashboard.roles show'),
            'links' => $links,
            'role' => $role,

        ];
        return view(dashboard() . '.roles.show', $data);
    }

    public function edit(Role $role)
    {
        $languages = Language::all();

        $links = [
            '#' => __('dashboard.roles'),
            route('dashboard.roles.index') => __('dashboard.roles list'),
            route('dashboard.roles.edit', $role) => __('dashboard.roles edit'),

        ];

        $data = [
            'page_title' => __('dashboard.roles edit'),
            'links' => $links,
            'role' => $role,
            'languages' => $languages,
        ];
        return view(dashboard() . '.roles.create', $data);
    }


    public function update(UpdateRoleRequest $request, Role $role)
    {
        return $this->role->update($request->all(),$role->id);


    }

    public function destroy(Role $role)
    {
        return $this->role->delete($role->id);
    }
}
