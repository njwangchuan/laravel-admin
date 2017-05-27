<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\Jobs\SendMail;
use Datatables;
use Log;

class UserController extends AdminController
{
  public function __construct()
  {
    view()->share('type', 'user');
  }

  /*
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index(Request $request)
  {
    // Show the page
    $mode = 'create';
    $querystring = $request->getQueryString();
    if (isset($querystring)) {
      return view('admin.user.index', compact('mode','querystring'));
    } else {
      return view('admin.user.index', compact('mode'));
    }
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function create(Request $request)
  {
    $mode = 'create';
    if ($request->has('role')) {
      $role = Role::where('name', $request->input('role'))->first();
      return view('admin.user.create_edit', compact('user', 'role', 'mode'));
    } else {
      $roles = Role::where('name','!=','owner')->get();
      return view('admin.user.create_edit', compact('user', 'roles', 'mode'));
    }
  }

  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function store(UserRequest $request)
  {
    $user = new User($request->except('password', 'password_confirmation'));
    $user->password = bcrypt($request->password);
    if (!$user->confirmed) {
      //Send a confirm email to new user;
      $user->confirmation_code = str_random(32);
      $this->dispatch(new SendMail($user));
    }
    $roleIds = $request->roles;
    $user->save();
    $user->roles()->sync($roleIds);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param $user
  *
  * @return Response
  */
  public function edit(Request $request,User $user)
  {
    $mode = 'edit';
    if ($request->has('role')) {
      $role = Role::where('name', $request->input('role'))->first();
      return view('admin.user.create_edit', compact('user', 'role', 'mode'));
    } else {
      $roles = Role::where('name','!=','owner')->get();
      return view('admin.user.create_edit', compact('user', 'roles', 'mode'));
    }
  }

  /**
  * Update the specified resource in storage.
  *
  * @param $user
  *
  * @return Response
  */
  public function update(UserRequest $request, User $user)
  {
    if (empty($request->email)) {
      $request->merge(array('email' => null));
    }
    $password = $request->password;
    $passwordConfirmation = $request->password_confirmation;

    if (!empty($password)) {
      if ($password === $passwordConfirmation) {
        $user->password = bcrypt($password);
      }
    }
    $roleIds = $request->roles;
    $user->roles()->sync($roleIds);
    $user->update($request->except('password', 'password_confirmation'));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param $user
  *
  * @return Response
  */
  public function delete(User $user)
  {
    return view('admin.user.delete', compact('user'));
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param $user
  *
  * @return Response
  */
  public function destroy(User $user)
  {
    $user->roles()->sync([]);
    $user->delete();
  }

  /**
  * Show a list of all the languages posts formatted for Datatables.
  *
  * @return Datatables JSON
  */
  public function data(Request $request)
  {
    $users = User::with('roles');
    $datas = Datatables::of($users)
    ->edit_column('confirmed', '@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif')
    ->add_column('actions', '@if ($id!="1")<a href="{{{ URL::to(\'admin/user/\' . $id . \'/edit\') }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
    <a href="{{{ URL::to(\'admin/user/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
    @endif')
    ->edit_column('roles', '@foreach ($roles as $role) <span class="label" style="background-color:{{$role[\'tag_color\']}}">{{ $role[\'display_name\']}}</span> @endforeach')
    ->make(true);
    return $datas;
  }
}
