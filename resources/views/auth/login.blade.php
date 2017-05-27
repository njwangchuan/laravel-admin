@extends('layouts.guest')

@section('styles')
@parent
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
<section id="page-top">
  <div class="container">
    <div class=row>
      <div class="index-login col-lg-4 col-lg-offset-7 col-md-5 col-md-offset-6">
        <h2><span>{!! trans("site/login.title") !!}</span></h2>
        <hr />
        <form class="index-login-form" role="form" method="POST" action="{{ url('login') }}">
          {!! csrf_field() !!}
          <div class="form-group">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="{!! trans('site/login.username_placeholder') !!}">
            @if ($errors->has('username'))
            <span class="help-block">
              <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="{!! trans('site/login.password_placeholder') !!}">
            @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
            <input type="captcha" class="form-control" name="captcha" autocomplete="off" placeholder="{!! trans('site/register.captcha_placeholder') !!}">
            @if ($errors->has('captcha'))
            <span class="help-block">
              <strong>{{ $errors->first('captcha') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
              <!-- <div class="btn-group" role="group">
                <a class="btn btn-link" href="{{ url('/password/reset') }}">{!! trans("site/login.forget") !!}</a>
              </div> -->
              <div class="btn-group" role="group">
                <a href="#" onclick="reloadCaptcha();"><img src="{{URL::to('captcha/create')}}" id="captcha-img"></a>
              </div>
              <!-- <div class="btn-group" role="group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember"> {!! trans("site/login.rememberme") !!}
                  </label>
                </div>
              </div> -->
              <div class="btn-group" role="group">
                <button type="submit" class="btn btn-default">
                  <i class="fa fa-btn fa-sign-in"></i> {!! trans("site/login.login") !!}
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
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
