@extends('admin.layouts.default_name_column')

{{-- Web site Title --}}
@section('title') {!! trans("admin/users.users") !!} :: @parent
@stop

{{-- Content --}}
@section('main')
<div class="row">
  <div class="col-lg-12">
    <h4 class="page-header">
      <ol class="breadcrumb">
        <li class=>{{ trans("admin/nav.accounts") }}</li>
        <li class="active">{!! trans("admin/users.users") !!}</li>
      </ol>
    </h4>
  </div>
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button
        class="btn btn-sm  btn-info refresh" type="button"><span
        class="glyphicon glyphicon-refresh"></span> {{trans("admin/modal.refresh") }}</button>
        @if (!isset($querystring))
        <a href="{!! URL::to('admin/user/create') !!}"
        class="btn btn-sm  btn-primary iframe"><span class="glyphicon glyphicon-plus-sign"></span>
        {{trans("admin/modal.new") }}</a>
        @else
        <a href="{!! URL::to('admin/user/create?'.$querystring) !!}"
        class="btn btn-sm  btn-primary iframe"><span class="glyphicon glyphicon-plus-sign"></span>
        {{trans("admin/modal.new") }}</a>
        @endif
      </div>
      <div class="panel-body">
        <table id="table" class="table table-striped table-hover">
          <thead>
            <tr>
              <th data-name="username">{!! trans("admin/users.username") !!}</th>
              <th data-name="display_name">{!! trans("admin/users.display_name") !!}</th>
              <th data-name="confirmed">{!! trans("admin/users.confirmed") !!}</th>
              <th data-name="created_at">{!! trans("admin/admin.created_at") !!}</th>
              <th data-name="roles">{!! trans("admin/admin.roles") !!}</th>
              <th data-name="actions">{!! trans("admin/admin.action") !!}</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop

{{-- Scripts --}}
@section('scripts')
@parent
@stop
