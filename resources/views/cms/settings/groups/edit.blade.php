@extends('sbadmin/layout')

@section('title') {{trans('app.edit_group')}} - {{trans('app.group_management')}} @endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">{{trans('app.edit_group')}} - {{trans('app.group_management')}}<small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">{{trans('app.dashboard')}}</a></li>
                <li><a href="#">{{trans('app.settings')}}</a></li>
                <li><a href="{{URL::to('settings/groups')}}">{{trans('app.group_management')}}</a></li>
                <li><a href="{{URL::to('settings/groups/'.$group->id.'/edit/')}}">{{trans('app.edit_group')}} ({{$group->value}})</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-users"></i> {{trans('app.group_info')}} - {{$group->value}}</div>
        </div>
        <div class="portlet-body form">

            {!! Form::model($group,['route'=>["settings.groups.update",$group->id],"class"=>"form-horizontal form-row-seperated"]) !!}

            {!! Form::hidden("_method","PUT")!!}

            <div class="form-body">

                <div class="form-group">
                    {!! Form::label('name',trans('app.title'),["class"=>"control-label col-md-2"]) !!}
                    <div class="col-md-10">{!! Form::text('name',null,["class"=>"form-control",'placeholder'=>trans('app.title')]) !!}</div>
                </div>

                <div class="form-groups">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-offset-2 col-md-10">
                                <br><br>
                                <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> {{trans('app.save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

    <div class="clearfix">

@endsection

@section('footer')

@endsection