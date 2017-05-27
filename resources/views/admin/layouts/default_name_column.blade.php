<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel Admin</title>
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
  content="Laravel Admin"/>
  @show
  @section('scripts')
  <script src="{{ asset('js/site.js') }}"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
  @show
  @section('styles')
  <link href="{{ asset('css/site.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  @show
</head>
<body>
  <div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand page-scroll" href="{{ (Request::is('home')||Request::is('/') ? '#page-top' : URL::to('home')) }}">
          <img alt="校友会" src="{{ asset('img/cgpi.jpg') }}" height="20">
        </a>
        <a class="navbar-brand" href="{{url('admin/dashboard')}}">Laravel Admin管理后台</a>
      </div>
      <!-- /.navbar-header -->
      <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> {{ Auth::user()->display_name }} <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-user">
            <li><a href="{{url('/')}}"><i class="fa fa-gear fa-fw"></i> 返回前端</a>
            </li>
            <li class="divider"></li>
            <li><a href="{{url('logout')}}"><i class="fa fa-sign-out fa-fw"></i> 退出</a>
            </li>
          </ul>
          <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
      </ul>
      <!-- /.navbar-top-links -->

      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">
          </li>
          <li>
            <a href="#">
              <i class="fa fa-cog"></i> {{ trans("admin/nav.accounts") }}
              <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">
              <li>
                <a href="{{url('admin/user')}}">
                  <i class="fa fa-user"></i> {{ trans("admin/nav.users") }}
                </a>
              </li>
              <li>
                <a href="{{url('admin/role')}}">
                  <i class="fa fa-group"></i> {{ trans("admin/nav.roles") }}
                </a>
              </li>
              <li>
                <a href="{{url('admin/permission')}}">
                  <i class="fa fa-key"></i> {{ trans("admin/nav.permissions") }}
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </div>
      <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
  </nav>
  <div id="page-wrapper">
    @yield('main')
  </div>
</div>
<script type="text/javascript">
var oTable;
var cols = [];
$(document).ready(function () {

  $('th').each(function (i, index) {
    var th = this;
    if ($(th).data('name')) {
      cols.push({
        data: $(th).data('name'),
        visible: $(th).data('visible'),
        searchable: $(th).data('searchable')?$(th).data('searchable'):false,
        orderable: $(th).data('orderable')?$(th).data('orderable'):false,
        defaultContent: $(th).data('default'),
        render: function (data, type, row) {
          if ($(th).data('function')&&typeof(eval($(th).data('function'))) === 'function'){
            var fRender = eval($(th).data('function'));
            return fRender(data,type,row);
          }else{
            return data;
          }
        }
      });
    }
  });

  oTable = $('#table').DataTable({
    "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
    "oLanguage": {
      "sProcessing": "{{ trans('table.processing') }}",
      "sLengthMenu": "{{ trans('table.showmenu') }}",
      "sZeroRecords": "{{ trans('table.noresult') }}",
      "sInfo": "{{ trans('table.show') }}",
      "sEmptyTable": "{{ trans('table.emptytable') }}",
      "sInfoEmpty": "{{ trans('table.view') }}",
      "sInfoFiltered": "{{ trans('table.filter') }}",
      "sInfoPostFix": "",
      "sSearch": "{{ trans('table.search') }}:",
      "sUrl": "",
      "oPaginate": {
        "sFirst": "{{ trans('table.start') }}",
        "sPrevious": "{{ trans('table.prev') }}",
        "sNext": "{{ trans('table.next') }}",
        "sLast": "{{ trans('table.last') }}"
      }
    },
    columns: cols,
    "processing": true,
    "serverSide": true,
    "ordering":  false,
    @if (isset($querystring))
    "ajax": "{!! $type !!}/data?{!!$querystring!!}",
    @else
    "ajax": "{!! $type !!}/data",
    @endif
    "fnDrawCallback": function (oSettings) {
      $(".iframe").colorbox({
        iframe: true,
        width: "90%",
        height: "90%",
        onClosed: function () {
          oTable.ajax.reload();
        }
      });
    }
  });

  $(".refresh").click(function(){
    oTable.ajax.reload();
  })
});
</script>
</body>
</html>
