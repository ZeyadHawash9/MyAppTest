<?php


namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Models\Brand;
use App\Repositories\Interfaces\Repository;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BrandEloquent implements Repository
{
    function anyData()
    {

        $Brand = Brand::select('*');
        return DataTables::of($Brand)

            ->editColumn('image', function ($Brand) {
                return '<img src="' . $Brand->image . '"  width="80px" height="80px" class="rounded-circle">';
            })
            ->editColumn('description', function ($Category) {
                return $Category->description;
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('dashboard.brands.show', $row->id) . '" class="btn btn-info btn-sm mx-2" ><i class="fa fa-eye"></i></a>';

                $btn .= '<a href="' . Route('dashboard.brands.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>';

                $btn .= '    <a  href="' . route('dashboard.brands.destroy', $row) . '" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-sm btn-clean btn-icon delete" title="Delete"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';

                return $btn;
            })
            ->addColumn('active', function ($row) {

                return '
                    <div class="col-md-9">
                        <div class="form-check form-switch form-check-custom form-check-solid me-10">
                            <form target="_self" id="FormToggleSubmit" class="FormToggleSubmit container max-w-3xl mx-auto" enctype="multipart/form-data">
                                <input type="hidden" name="url" value="' . route('dashboard.brands.status', $row) . '">
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
            $brand = new Brand();
            $brand->name = $attributes['name'];
            $brand->description = $attributes['description'];
            $brand->image = isset($attributes['image']) ? storePhoto('brands',  $attributes['image']) : '';
            $brand->save();
            DB::commit();
            return redirect()->route(dashboard() . '.brands.index')->with('message', __('category created successfully!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
            // return response()->json(['status' => false, 'statusCode' => 422, 'message' => $e->getMessage()], 422);
        }
    }

    function changeStatus($id)
    {
        try {
            DB::beginTransaction();
            $brand = Brand::find($id);
            $brand->is_active = !($brand->is_active);
            $brand->save();
            DB::commit();
            return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('brand status updated successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'statusCode' => 422, 'message' => $e->getMessage()], 422);
        }
    }
    function update(array $attributes, $id = null)
    {
        try {
            DB::beginTransaction();
            $brand = Brand::find($id);
            $brand->name = $attributes['name'];
            $brand->description = $attributes['description'];
            if (isset($attributes['image'])) {
                $brand->image =  storePhoto('brands',  $attributes['image']);
            }
            $brand->save();


            DB::commit();
            return redirect()->route(dashboard() . '.brands.index')->with('message', __('Category Update successfully!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'statusCode' => 422, 'message' => $e->getMessage()], 422);
        }
    }
    function delete($id)
    {
        try {
            DB::beginTransaction();
            $brand = Brand::find($id);
            $brand->delete();
            DB::commit();
            return response()->json(['status' => true, 'statusCode' => 200, 'message' => __('brand Destroy successfully!')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'statusCode' => 422, 'message' => $e->getMessage()], 422);
        }
    }
}
