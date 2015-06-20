@extends('sbadmin/layout')

@section('title') {{trans('app.user_management')}} @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">{{trans('app.settings')}} - {{trans('app.user_management')}}<small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">{{trans('app.dashboard')}}</a></li>
                <li><a href="#">{{trans('app.settings')}}</a></li>
                <li><a href="{{URL::to('settings/users')}}">{{trans('app.user_management')}}</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i> {{trans('app.users')}}
            </div>
            <div class="actions">
                @if(isperms('settings/users/create'))
                <a href="{{URL::to('settings/users/create')}}" class="btn btn-primary btn-xs yellow-stripe">
                    <i class="fa fa-plus"></i>
                    <span class="hidden-480"> {{trans('app.new_user')}}</span>
                </a>
                @endif
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="datatable_ajax2">
                    <thead>
                    <tr role="row" class="heading">
                        <th width="12%">{{trans('app.name')}}</th>
                        <th width="13%">{{trans('app.surname')}}</th>
                        <th width="15%">{{trans('app.email')}}</th>
                        <th width="20%">{{trans('app.roles')}}</th>
                        <th width="10%">{{trans('app.action')}}</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="clearfix">

@endsection


@section('footer')
    <script type="text/javascript">MT.getDataTable("{{ URL::to('settings/users/data/index') }}");</script>
@endsection