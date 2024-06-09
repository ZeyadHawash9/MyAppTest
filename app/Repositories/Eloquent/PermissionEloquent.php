<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\Repository;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionEloquent implements Repository
{
    function anyData()
    {

        $Permissions = Permission::select('*');
        return DataTables::of($Permissions)

            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('dashboard.permissions.show', $row->id) . '" class="btn btn-info btn-sm mx-2" ><i class="fa fa-eye"></i></a>';

                $btn .= '<a href="' . Route('dashboard.permissions.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';

                $btn .= '    <a  href="' . route('dashboard.permissions.destroy', $row) . '" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon delete" title="Delete"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';

                return $btn;
            })
            ->addColumn('active', function ($row) {

                return '
                    <div class="col-md-9">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <form target="_self" id="FormToggleSubmit" class="FormToggleSubmit container max-w-3xl mx-auto" enctype="multipart/form-data">
                                <input type="hidden" name="url" value="' . route('dashboard.permissions.status', $row) . '">
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
             Permission::create(['name' => $attributes['name']]);
            DB::commit();
            return redirect()->route(dashboard() . '.permissions.index')->with('message', __('Permission created successfully!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function changeStatus($id)
    {
        try {
            DB::beginTransaction();
            $Permission = Permission::find($id);
            $Permission->is_active = !($Permission->is_active);
            $Permission->save();
            DB::commit();
            return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('Permission status updated successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'statusCode' => 422, 'message' => $e->getMessage()], 422);
        }
    }
    function update(array $attributes, $id = null)
    {

        try {
            DB::beginTransaction();
            $Permission = Permission::find($id);
            $Permission->name = $attributes['name'];
            $Permission->save();


            DB::commit();
            return redirect()->route(dashboard() . '.permissions.index')->with('message', __('Permission Update successfully!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'statusCode' => 422, 'message' => $e->getMessage()], 422);
        }
    }
    function delete($id)
    {
        try {
            DB::beginTransaction();
            $Permission = Permission::find($id);
            $Permission->delete();
            DB::commit();
            return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('Permission Destroy successfully!')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'statusCode' => 422, 'message' => $e->getMessage()], 422);
        }
    }
}
