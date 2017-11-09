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

</div>
@endsection
