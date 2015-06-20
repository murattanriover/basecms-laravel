@extends('sbadmin/layout')

@section('title') {{trans('app.definitions')}} @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title"> {{trans('app.settings')}} - {{trans('app.definitions')}} <small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">{{trans('app.dashboard')}}</a></li>
                <li><a href="#">{{trans('app.settings')}}</a></li>
                <li><a href="{{URL::to('settings/config')}}">{{trans('app.definitions')}}</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i> {{trans('app.definitions')}}
            </div>
            <div class="actions">
                @if(isperms('settings/config/create'))
                <a href="{{URL::to('settings/config/create')}}" class="btn btn-primary btn-xs yellow-stripe">
                    <i class="fa fa-plus"></i>
                    <span class="hidden-480"> {{trans('app.new_definition')}}</span>
                </a>
                @endif
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <table class="table table-striped table-bordered table-hover" id="datatable_ajax2">
                    <thead>
                    <tr role="row" class="heading">
                        <th width="40%">{{trans('app.title')}}</th>
                        <th width="40%">{{trans('app.value')}}</th>
                        <th width="20%">{{trans('app.action')}}</th>
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
    <script type="text/javascript">MT.getDataTable("{{ URL::to('settings/config/data/index') }}");</script>
@endsection