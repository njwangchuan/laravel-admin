@extends('admin.layouts.default_name_column')

{{-- Web site Title --}}
@section('title') {{ trans("admin/admin.dashboard") }} :: @parent @stop

{{-- Content --}}
@section('main')
<div class="row">
  <!-- <div class="col-lg-12">
    <h3 class="page-header">
      {{ trans("admin/admin.dashboard") }}
    </h3>
  </div> -->
</div>
<div class="row">
  <!-- <div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
            <i class="fa fa-users fa-5x"></i>
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge">{{$users}}</div>
            <div>{{ trans("admin/admin.users") }}</div>
          </div>
        </div>
      </div>
      <a href="{{URL::to('admin/user')}}">
        <div class="panel-footer">
          <span class="pull-left">{{ trans("admin/admin.view_detail") }}</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

          <div class="clearfix"></div>
        </div>
      </a>
    </div>
  </div> -->
</div>
@endsection
