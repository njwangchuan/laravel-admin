@extends('layouts.guest')

@section('styles')
@parent
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="page-top">
  <div class="container" style="padding-top:100px">
    <div class="row">
      <div class="index-login col-lg-4 col-lg-offset-7 col-md-5 col-md-offset-6">
        <h2><span>{!! trans("site/register.title") !!}</span></h2>
        <hr />
        <form class="index-login-form" role="form" method="POST" action="{{ URL::to('register') }}">
          {!! csrf_field() !!}
          <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="{!! trans('site/register.name_placeholder') !!}">
            @if ($errors->has('username'))
            <span class="help-block">
              <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="display_name" value="{{ old('display_name') }}" placeholder="{!! trans('site/register.display_name_placeholder') !!}">
            @if ($errors->has('display_name'))
            <span class="help-block">
              <strong>{{ $errors->first('display_name') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{!! trans('site/register.email_placeholder') !!}">
            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="{!! trans('site/register.phone_placeholder') !!}">
            @if ($errors->has('phone'))
            <span class="help-block">
              <strong>{{ $errors->first('phone') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="{!! trans('site/register.password_placeholder') !!}">
            @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="{!! trans('site/register.password_comfirmation_placeholder') !!}">
            @if ($errors->has('password_confirmation'))
            <span class="help-block">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
            <input type="captcha" class="form-control" name="captcha" placeholder="{!! trans('site/register.captcha_placeholder') !!}">
            @if ($errors->has('captcha'))
            <span class="help-block">
              <strong>{{ $errors->first('captcha') }}</strong>
            </span>
            @endif
          </div>

          <div class="form-group">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
              <div class="btn-group" role="group">
                <a href="#" onclick="reloadCaptcha();" class="pull-left" style="width:50%"><img src="{{URL::to('captcha/create')}}" id="captcha-img"></a>
              </div>
              <div class="btn-group" role="group">

              </div>
              <div class="btn-group" role="group">
                <button type="submit" class="btn btn-default">
                  <i class="fa fa-btn fa-sign-in"></i> {!! trans("site/register.register") !!}
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script type="text/javascript">
function reloadCaptcha(){
  $("#captcha-img").attr("src","{{URL::to('captcha/create')}}?rand="+Math.random());
  return false;
}
</script>
@stop
