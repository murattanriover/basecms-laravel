@extends('sbadmin/layout')

@section('title') {{trans('app.group_management')}} @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title"> {{trans('app.settings')}} - {{trans('app.group_management')}} <small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">{{trans('app.dashboard')}}</a></li>
                <li><a href="#">{{trans('app.settings')}}</a></li>
                <li><a href="{{URL::to('settings/groups')}}">{{trans('app.group_management')}}</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i> {{trans('app.groups')}}
            </div>
            <div class="actions">
                {!! permslink('settings/groups/create','<i class="fa fa-plus"></i><span class="hidden-480"> '.trans('app.new_group').'</span>',['class'=>"btn btn-primary btn-xs yellow-stripe"])!!}
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="datatable_ajax2">
                    <thead>
                    <tr role="row" class="heading">
                        <th width="70%">{{trans('app.title')}}</th>
                        <th width="30%">{{trans('app.action')}}</th>
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
    <script type="text/javascript">MT.getDataTable("{{ URL::to('settings/groups/data/index') }}");</script>
@endsection