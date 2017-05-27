<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@section('title') Laravel Admin Form @show</title>
  @section('favicon')
  <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicon/android-icon-192x192.png')}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
  <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
  <meta name="theme-color" content="#ffffff">
  @show
  @section('meta_keywords')
  <meta name="keywords" content="Laravel Admin"/>
  @show
  @section('meta_author')
  <meta name="author" content="njwangchuan"/>
  @show
  @section('meta_description')
  <meta name="description"
  content="Laravel Admin Form"/>
  @show
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('css/site.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  <script src="{{ asset('js/site.js') }}"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
  @yield('styles')
</head>
<!-- Container -->
<div class="container">
  <div class="page-header">
    <div class="pull-right">
      <button class="btn btn-primary btn-xs close_popup">
        <span class="glyphicon glyphicon-backward"></span> {!! trans('admin/admin.back')!!}
      </button>
    </div>
  </div>
  <!-- Content -->
  @yield('content')
  <script type="text/javascript">
  $(function () {
    $('textarea').summernote({
      height: 250,
      lang: 'zh-CN',
      callbacks: {
        onImageUpload: function(files, editor, welEditable) {
          // upload image to server and create imgNode...
          for (var i = files.length - 1; i >= 0; i--) {
            sendFile(files[i], this);
          }
        }
      }
    });
    $('form').submit(function (event) {
      event.preventDefault();
      var form = $(this);
      //alert('form submit');
      if (form.attr('id') == '' || form.attr('id') != 'fupload') {
        $.ajax({
          type: form.attr('method'),
          url: form.attr('action'),
          data: form.serialize()
        }).success(function () {
          setTimeout(function () {
            parent.$.colorbox.close();
          }, 10);
        }).fail(function (jqXHR, textStatus, errorThrown) {
          // Optionally alert the user of an error here...
          var textResponse = jqXHR.responseText;
          var alertText = "{!! trans('admin/modal.ajaxFail')!!}:\n\n";
          var jsonResponse = jQuery.parseJSON(textResponse);

          $.each(jsonResponse, function (n, elem) {
            alertText = alertText + elem + "\n";
          });
          alert(alertText);
        });
      }
      else {
        var formData = new FormData(this);
        $.ajax({
          type: form.attr('method'),
          url: form.attr('action'),
          data: formData,
          mimeType: "multipart/form-data",
          contentType: false,
          cache: false,
          processData: false
        }).success(function () {
          setTimeout(function () {
            parent.$.colorbox.close();
          }, 10);

        }).fail(function (jqXHR, textStatus, errorThrown) {
          var textResponse = jqXHR.responseText;
          var alertText = "{!! trans('admin/modal.ajaxFail')!!}:\n\n";
          var jsonResponse = jQuery.parseJSON(textResponse);

          $.each(jsonResponse, function (n, elem) {
            alertText = alertText + elem + "\n";
          });

          alert(alertText);
        });
      };
    });

    $('.close_popup').click(function () {
      parent.$.colorbox.close();
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  });

  function sendFile(file,el) {
    data = new FormData();
    data.append('type', 'image');
    data.append('image', file);
    $.ajax({
      data: data,
      type: "POST",
      url: '{!! URL::to("admin/ajax/image/upload") !!}',
      cache: false,
      contentType: false,
      processData: false,
      success: function(url) {
        $(el).summernote('editor.insertImage', url);
      }
    });
  }

  </script>
  @yield('scripts')
</div>
</body>
</html>
