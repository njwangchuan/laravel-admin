@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
@if (isset($user))
{!! Form::model($user, array('url' => URL::to('admin/user') . '/' . $user->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => URL::to('admin/user'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
<div class="tab-content">
  <!-- General tab -->
  <div class="tab-pane active" id="tab-general">
    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
      {!! Form::label('username', trans("admin/users.username"), array('class' => 'control-label')) !!}
      <div class="controls">
        {!! Form::text('username', null, array('class' => 'form-control')) !!}
        <span class="help-block">{{ $errors->first('username', ':message') }}</span>
      </div>
    </div>
    <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
      {!! Form::label('display_name', trans("admin/users.display_name"), array('class' => 'control-label')) !!}
      <div class="controls">
        {!! Form::text('display_name', null, array('class' => 'form-control')) !!}
        <span class="help-block">{{ $errors->first('display_name', ':message') }}</span>
      </div>
    </div>
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      {!! Form::label('email', trans("admin/users.email"), array('class' => 'control-label')) !!}
      <div class="controls">
        {!! Form::text('email', null, array('class' => 'form-control')) !!}
        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
      </div>
    </div>
    <div class="form-group  {{ $errors->has('phone') ? 'has-error' : '' }}">
      {!! Form::label('phone', trans("admin/users.phone"), array('class' => 'control-label')) !!}
      <div class="controls">
        {!! Form::number('phone', null, array('class' => 'form-control')) !!}
        <span class="help-block">{{ $errors->first('phone', ':message') }}</span>
      </div>
    </div>
    @if	(!isset($user))
    <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
      {!! Form::label('password', trans("admin/users.password"), array('class' => 'control-label')) !!}
      <div class="controls">
        {!! Form::password('password', array('class' => 'form-control')) !!}
        <span class="help-block">{{ $errors->first('password', ':message') }}</span>
      </div>
    </div>
    <div class="form-group  {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
      {!! Form::label('password_confirmation', trans("admin/users.password_confirmation"), array('class' => 'control-label')) !!}
      <div class="controls">
        {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
        <span class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
      </div>
    </div>
    @endif
    <div class="form-group  {{ $errors->has('confirmed') ? 'has-error' : '' }}">
      {!! Form::label('confirmed', trans("admin/users.active_user"), array('class' => 'control-label')) !!}
      <div class="controls">
        {!! Form::label('confirmed', trans("admin/users.yes"), array('class' => 'control-label')) !!}
        {!! Form::radio('confirmed', '1', @isset($user)? $user->confirmed : 'false') !!}
        {!! Form::label('confirmed', trans("admin/users.no"), array('class' => 'control-label')) !!}
        {!! Form::radio('confirmed', '0', @isset($user)? $user->confirmed : 'true') !!}
        <span class="help-block">{{ $errors->first('confirmed', ':message') }}</span>
      </div>
    </div>

    @if	(isset($role))
    {{ Form::hidden('roles[]', $role->id) }}
    @else
    <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
      {!! Form::label('roles', trans("admin/users.roles"), array('class' => 'control-label')) !!}
      <select class="form-control select2-multiple" name="roles[]" id="roles" multiple>
        @foreach ($roles as $role)
        @if ($mode == 'create')
        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
        @else
        <option value="{{ $role->id }}" {{ ( $user->hasRole($role->name) ? ' selected="selected"' : '') }}>{{ $role->display_name }}</option>
        @endif
        @endforeach
      </select>
    </div>
    @endif

  </div>
  <div class="form-group">
    <div class="col-md-12">
      <button type="reset" class="btn btn-sm btn-warning close_popup">
        <span class="glyphicon glyphicon-ban-circle"></span> {{ trans("admin/modal.cancel") }}
      </button>
      <button type="reset" class="btn btn-sm btn-default">
        <span class="glyphicon glyphicon-remove-circle"></span> {{ trans("admin/modal.reset") }}
      </button>
      <button type="submit" class="btn btn-sm btn-success">
        <span class="glyphicon glyphicon-ok-circle"></span>
        @if	(isset($user))
        {{ trans("admin/modal.edit") }}
        @else
        {{trans("admin/modal.create") }}
        @endif
      </button>
    </div>
  </div>
  {!! Form::close() !!}
</div>
@stop
@section('scripts')
<script type="text/javascript">
$(function () {
  $("#roles").select2();
});
</script>
@stop
