@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
@if (isset($role))
{!! Form::model($role, array('url' => URL::to('admin/role') . '/' . $role->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => URL::to('admin/role'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : '' }}">
            {!! Form::label('name', trans("admin/roles.name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('display_name') ? 'has-error' : '' }}">
            {!! Form::label('display_name', trans("admin/roles.display_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('display_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('display_name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('description') ? 'has-error' : '' }}">
            {!! Form::label('description', trans("admin/roles.description"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('description', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('description', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('tag_color') ? 'has-error' : '' }}">
            {!! Form::label('tag_color', trans("admin/roles.tag_color"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('tag_color', null, array('class' => 'form-control','id'=> 'tag-color-selector')) !!}
                <span class="help-block">{{ $errors->first('tag_color', ':message') }}</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <button type="reset" class="btn btn-sm btn-warning close_popup">
                <span class="glyphicon glyphicon-ban-circle"></span> {{
				trans("admin/modal.cancel") }}
            </button>
            <button type="reset" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-remove-circle"></span> {{
				trans("admin/modal.reset") }}
            </button>
            <button type="submit" class="btn btn-sm btn-success">
                <span class="glyphicon glyphicon-ok-circle"></span>
                @if	(isset($role))
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
$(function(){
  $('#tag-color-selector').colorpicker();
});
</script>
@stop
