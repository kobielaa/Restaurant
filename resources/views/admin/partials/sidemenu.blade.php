<div class="sidebar-container">
  <div class="sidebar-header">
    <div class="brand">
      <div class="logo">
        <span class="l l1"></span>
        <span class="l l2"></span>
        <span class="l l3"></span>
        <span class="l l4"></span>
        <span class="l l5"></span>
      </div> Admin Panel </div>
  </div>
  <nav class="menu">
    <ul class="sidebar-menu metismenu" id="sidebar-menu">
      <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Frontpage </a></li>
      <li><a href="{{route('admin.index')}}"><i class="fa fa-th-large"></i> Dashboard </a></li>
      <li><a href><i class="fa fa-file"></i> Invoices </a></li>
      <li><a href><i class="fa fa-envelope"></i> Mailing </a></li>
      <li>
        <a href>
          <i class="fa fa-money"></i>Payments
          <i class="fa arrow"></i>
        </a>
        <ul class="sidebar-nav">
          <li><a href="{{route('admin.payments.types.index')}}">@lang('payments.types.types')</a></li>
          <li><a href="{{route('admin.payments.periods.index')}}">@lang('payments.periods.periods')</a></li>
          <li><a href="{{route('admin.payments.prices.index')}}">@lang('payments.prices.prices')</a></li>
          <li><a href="{{route('admin.payments.codes.index')}}">@lang('payments.codes.codes')</a></li>
        </ul>
      </li>
      <li>
        <a href>
          <i class="fa fa-link"></i>@lang('subdomains.subdomains')
          <i class="fa arrow"></i>
        </a>      
        <ul class="sidebar-nav">
          <li><a href="{{route('admin.subdomains.subdomains.index')}}">@lang('subdomains.subdomains')</a></li>
          <li><a href>@lang('subdomains.templates.templates')</a></li>
        </ul>
      </li>
      <li>
        <a href>
          <i class="fa fa-newspaper-o"></i>@lang('adverts.adverts')
          <i class="fa arrow"></i>
        </a>
        <ul class="sidebar-nav">
          <li><a href="{{route('admin.adverts.adverts.index')}}">@lang('adverts.adverts')</a></li>
          <li><a href="{{route('admin.adverts.types.index')}}">@lang('adverts.types.types')</a></li>
          <li><a href="{{route('admin.adverts.categories.index')}}">@lang('adverts.categories.categories')</a></li>
        </ul>
      </li>
      <li><a href="{{route('cusines.index')}}"><i class="fa fa-cutlery"></i>@lang('cusines.cusines') </a></li>
      <li>
        <a href>
          <i class="fa fa-globe"></i>@lang('locations.locations')
          <i class="fa arrow"></i>
        </a>
        <ul class="sidebar-nav">
            <li><a href="{{route('admin.locations.countries.index')}}">@lang('locations.countries.countries')</a></li>
            <li><a href="{{route('admin.locations.cities.index')}}">@lang('locations.cities.cities')</a></li>
            <li><a href="{{route('admin.locations.languages.index')}}">@lang('locations.languages.languages')</a></li>
        </ul>
      </li>
      <li>
        <a href>
          <i class="fa fa-users"></i>@lang('users.users') 
          <i class="fa arrow"></i>
        </a>
        <ul class="sidebar-nav">
            <li><a href="{{route('admin.users.users.index')}}">@lang('users.users')</a></li>
            <li><a href="{{route('admin.users.types.index')}}">@lang('users.types.types')</a></li>
            <li><a href="{{route('admin.users.specializations.index')}}">@lang('users.specializations.specializations')</a></li>
            <li><a href="{{route('admin.users.genders.index')}}">@lang('users.genders.genders')</a></li>
            <li><a href="{{route('admin.users.jobs.index')}}">@lang('users.jobs.jobs')</a></li>
            {{--  <li><a href>Roles</a></li>
            <li><a href="{{ route('admin.users.permissions.index') }}">Permissions</a></li>  --}}
        </ul>
      </li>
    </ul>
  </nav>
</div>