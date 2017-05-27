<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Permission;
use App\Http\Requests\Admin\PermissionRequest;
use Datatables;

class PermissionController extends AdminController
{
  public function __construct()
  {
    view()->share('type', 'permission');
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    // Show the page
    return view('admin.permission.index');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('admin.permission.create_edit');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param \Illuminate\Http\Request $request
  *
  * @return \Illuminate\Http\Response
  */
  public function store(PermissionRequest $request)
  {
    $permission = new Permission ($request->except('permission_name','permission_code'));
    $permission->permission_name = $request->permission_name;
    $permission->permission_code = $request->permission_code;
    $permission->save();
  }

  /**
  * Display the specified resource.
  *
  * @param int $id
  *
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param int $id
  *
  * @return \Illuminate\Http\Response
  */
  public function edit(Permission $permission)
  {
    return view('admin.permission.create_edit', compact('permission'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param \Illuminate\Http\Request $request
  * @param int                      $id
  *
  * @return \Illuminate\Http\Response
  */
  public function update(PermissionRequest $request, Permission $permission)
  {
    $permission->update($request->except('permission_name','permission_code'));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param int $id
  *
  * @return \Illuminate\Http\Response
  */
  public function destroy(Permission $permission)
  {
    $permission->delete();
  }

  /**
  * Show a list of all the languages posts formatted for Datatables.
  *
  * @return Datatables JSON
  */
  public function data()
  {
    $permissions = Permission::all();
    //$permissions = Permission::select(array('permissions.id', 'permissions.name', 'permissions.display_name','permissions.description','permissions.created_at'));
    return Datatables::of($permissions)
    ->add_column('actions', '@if ($id!="1")<a href="{{{ URL::to(\'admin/permission/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
    <a href="{{{ URL::to(\'admin/permission/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
    @endif')
    ->make(true);
  }

}
