@extends('admin.layouts.modal')
{{-- Content --}}
@section('content')
@if (isset($permission))
{!! Form::model($permission, array('url' => URL::to('admin/permission') . '/' . $permission->id, 'method' => 'put', 'class' => 'bf', 'files'=> true)) !!}
@else
{!! Form::open(array('url' => URL::to('admin/permission'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
@endif
        <!-- Tabs Content -->
<div class="tab-content">
    <!-- General tab -->
    <div class="tab-pane active" id="tab-general">
        <div class="form-group  {{ $errors->has('permission_name') ? 'has-error' : '' }}">
            {!! Form::label('permission_name', trans("admin/permissions.permission_name"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('permission_name', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('permission_name', ':message') }}</span>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('permission_code') ? 'has-error' : '' }}">
            {!! Form::label('permission_code', trans("admin/permissions.permission_code"), array('class' => 'control-label')) !!}
            <div class="controls">
                {!! Form::text('permission_code', null, array('class' => 'form-control')) !!}
                <span class="help-block">{{ $errors->first('permission_code', ':message') }}</span>
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
                @if	(isset($permission))
                    {{ trans("admin/modal.edit") }}
                @else
                    {{trans("admin/modal.create") }}
                @endif
            </button>
        </div>
    </div>
    {!! Form::close() !!}
    @stop @section('scripts')
        <script type="text/javascript">
            $(function () {
                $("#permissions").select2()
            });
        </script>
</div>
@stop
