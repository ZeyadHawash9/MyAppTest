<?php


namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Models\Brand;
use App\Repositories\Interfaces\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleEloquent implements Repository
{
    function anyData()
    {

        $roles = Role::select('*');
        return DataTables::of($roles)

            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('dashboard.roles.show', $row->id) . '" class="btn btn-info btn-sm mx-2" ><i class="fa fa-eye"></i></a>';

                $btn .= '<a href="' . Route('dashboard.roles.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';

                $btn .= '    <a  href="' . route('dashboard.roles.destroy', $row) . '" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon delete" title="Delete"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';

                return $btn;
            })
            ->addColumn('active', function ($row) {

                return '
                    <div class="col-md-9">
                        <div class="form-check form-switch form-check-custom form-check-solid  ">
                            <form target="_self" id="FormToggleSubmit" class="FormToggleSubmit container max-w-3xl mx-auto" enctype="multipart/form-data">
                                <input type="hidden" name="url" value="' . route('dashboard.roles.status', $row) . '">
                                <input type="hidden" name="id" value="' . $row->id . '">

                                <input class="form-check-input h-30px w-50px make-switch active" name="autotimezone" type="checkbox" value=""
                                data-id="' . $row->id . '"       id="autotimezone" ' . ($row->is_active == 1 ? 'checked' : '') . ' >
                            </form>
                        </div>
                    </div>';
            })
            ->addIndexColumn()->rawColumns(['action', 'image', 'active'])->toJson();
    }

    function getAll(array $attributes)
    {
    }
    function getById($id)
    {
    }
    function create(array $attributes)
    {
        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $attributes['name']]);
            if (!empty($attributes['permissions'])) $role->givePermissionTo($attributes['permissions']);
            DB::commit();
            return redirect()->route(dashboard() . '.roles.index')->with('message', __('role created successfully!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function changeStatus($id)
    {
        try {
            DB::beginTransaction();
            $role = Role::findOrFail($id);
            $role->is_active = !($role->is_active);
            $role->save();
            DB::commit();
            return response_api(true, 200, 'role status updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response_api(false, 422, $e->getMessage());
        }
    }
    function update(array $attributes, $id = null)
    {
        try {
            DB::beginTransaction();
            $role = Role::findOrFail($id);
            $role->name = $attributes['name'];
            if (!empty($attributes['permissions'])) $role->syncPermissions($attributes['permissions']);
            else $role->syncPermissions([]);
            $role->save();
            DB::commit();
            return redirect()->route(dashboard() . '.roles.index')->with('message', __('role Update successfully!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function delete($id)
    {

        try {
            DB::beginTransaction();
            $role = Role::findOrFail($id);
            $role->delete();
            DB::commit();
            return response_api(true, 200, 'role Destroy successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return response_api(false, 422, $e->getMessage());
        }
    }
}
