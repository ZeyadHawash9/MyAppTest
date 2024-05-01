<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminCreateRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();

        return view('admin.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCreateRequest $request)
    {


        $admin = Admin::create([
            'name' => $request->input('name'),
            'user_name' => $request->input('user_name'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'image' => $request->hasFile('image') ? $request->file('image')->store('uploads', 'public') : null,
        ]);
        return redirect()->route('dashboard.admins.index')->with('success', 'Admin created successfully!');
    }

    public function changeStatus(string $id)
    {

        $admin = Admin::find($id);
        $admin->is_active = $admin->is_active ==  1  ? 0 : 1;
        $admin->save();
        return response()->json(['message' => 'Admin status updated successfully'], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::FindOrFail($id);

        $data = ['admin' => $admin];
        return view('admin.admin.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::FindOrFail($id);

        $data = ['admin' => $admin];
        return view('admin.admin.create', $data);
    }

    /**
     * Update the specified resource in storage.
     */
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
        return redirect()->route('dashboard.admins.index')->with('success', 'Admin update successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Admin::destroy($id);
        return redirect()->route('dashboard.admins.index')->with('success', 'Admin Destroy successfully!');
    }
}
