@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            <li>
                <a href="{{url('admin/calendar')}}">
                  <i class="fa fa-calendar"></i>
                  <span class="title">
                    Calendar
                  </span>
                </a>
            </li>
        
            @can('upravljanje_korisnicima_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.upravljanje-korisnicima.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('quickadmin.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('ispiti_access')
            <li>
                <a href="{{ route('admin.ispitis.index') }}">
                    <i class="fa fa-book"></i>
                    <span>@lang('quickadmin.ispiti.title')</span>
                </a>
            </li>@endcan
            
            @can('fakulteti_access')
            <li>
                <a href="{{ route('admin.fakultetis.index') }}">
                    <i class="fa fa-stack-exchange"></i>
                    <span>@lang('quickadmin.fakulteti.title')</span>
                </a>
            </li>@endcan
            
            @can('predmeti_access')
            <li>
                <a href="{{ route('admin.predmetis.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span>@lang('quickadmin.predmeti.title')</span>
                </a>
            </li>@endcan
            
            @can('profesori_access')
            <li>
                <a href="{{ route('admin.profesoris.index') }}">
                    <i class="fa fa-drivers-license-o"></i>
                    <span>@lang('quickadmin.profesori.title')</span>
                </a>
            </li>@endcan
            
            @can('studenti_access')
            <li>
                <a href="{{ route('admin.studentis.index') }}">
                    <i class="fa fa-address-card"></i>
                    <span>@lang('quickadmin.studenti.title')</span>
                </a>
            </li>@endcan
            
            @can('skolarina_access')
            <li>
                <a href="{{ route('admin.skolarinas.index') }}">
                    <i class="fa fa-money"></i>
                    <span>@lang('quickadmin.skolarina.title')</span>
                </a>
            </li>@endcan
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

