@extends('sbadmin/layout')

@section('title') {{trans('app.new_user')}} - {{trans('app.user_management')}} @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">{{trans('app.new_user')}} - {{trans('app.user_management')}}<small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">{{trans('app.dashboard')}}</a></li>
                <li><a href="#">{{trans('app.settings')}}</a></li>
                <li><a href="{{URL::to('settings/users')}}">{{trans('app.user_management')}}</a></li>
                <li><a href="{{URL::to('settings/users/create')}}">{{trans('app.new_user')}}</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-users"></i> {{trans('app.new_user')}}</div>
        </div>
        <div class="portlet-body form">

            {!! Form::open(['route'=>"settings.users.store","class"=>"form-horizontal form-row-seperated"]) !!}

                <div class="form-body">

                    <div class="form-group">
                        {!! Form::label('name',trans('app.name'),["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::text('name','',["class"=>"form-control",'placeholder'=>trans('app.name')]) !!}</div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('surname',trans('app.surname'),["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::text('surname','',["class"=>"form-control",'placeholder'=>trans('app.surname')]) !!}</div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email',trans('app.email'),["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::email('email','',["class"=>"form-control",'placeholder'=>trans('app.email')]) !!}</div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password',trans('app.password'),["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::password('password',["class"=>"form-control",'placeholder'=>trans('app.password')]) !!}</div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password_repeat',trans('app.password_repeat'),["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::password('password_repeat',["class"=>"form-control",'placeholder'=>trans('app.password_repeat')]) !!}</div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('groups',trans('app.roles'),["class"=>"control-label col-md-2"]) !!}
                        <div class="col-md-10">{!! Form::select('groups[]',$groups,null,["class"=>"form-control",'placeholder'=>trans('app.roles'),'multiple'=>"multiple"]) !!}</div>
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