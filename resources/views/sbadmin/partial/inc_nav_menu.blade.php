<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            @if(isperms('/')) <li><a href="{{url('/')}}" class="@if(Request::segment(1)=="dashboard" || Request::segment(1)=="") active @endif"><i class="fa fa-dashboard fa-fw"></i> {{trans('app.dashboard')}}</a></li> @endif

            @if(isperms('settings/url') || isperms('settings/groups') || isperms('settings/config'))
            <li class="@if(Request::segment(1)=="settings") active @endif">
                <a href="#" class="@if(Request::segment(1)=="settings") active @endif"><i class="fa fa-wrench fa-fw"></i> {{trans('app.settings')}}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    @if(isperms('settings/users'))<li><a href="{{url('settings/users')}}" class="@if(Request::segment(2)=="users") active @endif">{{trans('app.user_management')}}</a></li> @endif
                    @if(isperms('settings/groups'))<li><a href="{{url('settings/groups')}}" class="@if(Request::segment(2)=="groups") active @endif">{{trans('app.group_management')}}</a></li> @endif
                    @if(isperms('settings/config'))<li><a href="{{url('settings/config')}}" class="@if(Request::segment(2)=="config") active @endif">{{trans('app.definitions')}}</a></li> @endif
                </ul>
                <!-- /.nav-second-level -->
            </li>
            @endif

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>