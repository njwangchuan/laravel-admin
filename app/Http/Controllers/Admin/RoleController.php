<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Role;
use App\Http\Requests\Admin\RoleRequest;
use Datatables;

class RoleController extends AdminController
{
  public function __construct()
  {
    view()->share('type', 'role');
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    // Show the page
    return view('admin.role.index');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('admin.role.create_edit');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param \Illuminate\Http\Request $request
  *
  * @return \Illuminate\Http\Response
  */
  public function store(RoleRequest $request)
  {
    $role = new Role();
    $role->name = $request->input('name');
    $role->display_name = $request->input('display_name');
    $role->description = $request->input('description');
    $role->tag_color = $request->input('tag_color');
    $role->save();
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
  public function edit(Role $role)
  {
    return view('admin.role.create_edit', compact('role'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param \Illuminate\Http\Request $request
  * @param int                      $id
  *
  * @return \Illuminate\Http\Response
  */
  public function update(RoleRequest $request, Role $role)
  {
    $role->name = $request->input('name');
    $role->display_name = $request->input('display_name');
    $role->description = $request->input('description');
    $role->tag_color = $request->input('tag_color');
    $role->save();
  }

  public function delete(Role $role)
  {
    return view('admin.role.delete', compact('role'));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param int $id
  *
  * @return \Illuminate\Http\Response
  */
  public function destroy(Role $role)
  {
    $role->delete();
  }

  /**
  * Show a list of all the languages posts formatted for Datatables.
  *
  * @return Datatables JSON
  */
  public function data()
  {
    //$roles = Role::select(array('roles.id', 'roles.name', 'roles.display_name', 'roles.description', 'roles.tag_color', 'roles.created_at'));
    $roles = Role::with('users');

    $data = Datatables::of($roles)
    ->addColumn('actions', '@if ($id!="1")<a href="{{{ URL::to(\'admin/role/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
    <a href="{{{ URL::to(\'admin/role/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
    @endif')
    ->addColumn('users_count', function($role){
      return count($role->users);
    })
    ->editColumn('tag_color', '<span class="label" style="background-color:{{$tag_color}}">{{ $name}}</span>')
    ->make(true);
    return $data;
  }
}
