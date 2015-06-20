@extends('sbadmin/layout')

@section('title') {{trans('app.group_perms_management')}} @endsection

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
                <li><a href="{{URL::to('settings/groups/data/perms/'.$group->id)}}">{{trans('app.group_perms_management')}}</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i> {{$group->name}} {{trans('app.perms')}}
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">

                @if(!isset($controllers) && count($controllers)<1)
                    <div class="alert alert-danger" role="alert">{{trans('app.controller_not_found')}}!</div>
                @else

                    {!! Form::open(['action'=>["Admin\Settings\GroupController@postPerms",$group->id],"class"=>""]) !!}

                    <table class="table table-striped table-bordered">
                        <thead><tr role="row" class="heading success"><th><label class="checkbox-inline"><input type="checkbox" name="allperms" class="allperms" value="1" @if(isset($currentperms['all___all'])) checked="checked" @endif> {{trans('app.all_perms')}}</label>   <button class="btn btn-xs btn-success text-right" style="float:right;">{{trans('app.save')}}</button>     </th></tr></thead>
                    </table>

                    <br><br>

                    @foreach($controllers AS $row=>$item)
                        {{-- Controller And AuthController Hidden --}}
                        @if($item['class']!="Controller" && $item['class']!="AuthController")

                            @if(strlen($item['namespace'])>0)
                                @set $classname=strtolower($item['namespace']."\\".$item['class'])
                            @else
                                @set $classname=strtolower($item['namespace'].$item['class'])
                            @endif

                            <table class="table table-bordered table-striped">
                                <thead><tr role="row" class="active"><th>
                                    {{$item['class']}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="checkbox-inline"><input type="checkbox" name="perms[]" class="permsitem permsallmethod" @if(isset($currentperms[$classname."___all"])) checked="checked" @endif value="{{$classname}}___allmethods" > {{trans('app.all_methods')}} </label>
                                </th></tr></thead>
                                <tbody><tr><td>
                                    <table class="table table-no-border"><tr>
                                    @foreach($item['method'] AS $r=>$method)
                                        @if($r%5==0 && $r!=0) </tr><tr> @endif
                                        <td>
                                            <label class="checkbox-inline">
                                                <input name="perms[]" class="permsitem" type="checkbox" @if(isset($currentperms[$classname."___".strtolower($method)])) checked="checked" @endif value="{{$classname}}___{{strtolower($method)}}"> {{$method}}
                                            </label>
                                        </td>
                                    @endforeach
                                    </tr></table></td></tr></tbody>
                            </table>

                        @endif

                    @endforeach

                    <div class="form-groups">
                        <div class="row">
                            <div class="col-md-12">
                                <br><br>
                                <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> {{trans('app.save')}}</button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                @endif

            </div>

        </div>
    </div>

    <div class="clearfix">

@endsection


@section('footer')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.allperms').change(function(){
                if($(this).is(":checked")===true) {
                    $('.permsitem').prop("checked",true);
                    $('.permsitem').prop("disabled",true);
                } else{
                    $('.permsitem').prop('disabled',false);
                    $('.permsitem').prop('checked',false);
                }
            });
            $('.permsallmethod').change(function () {
                var sbitems = $(this).parents('table').find("table input.permsitem");
                if($(this).is(":checked")===true) {
                    sbitems.prop("checked",true);
                    sbitems.prop("disabled",true);
                } else{
                    sbitems.prop('disabled',false);
                    sbitems.prop('checked',false);
                }
            });
            if($('.allperms').is(":checked")===true) {
                $('.permsitem').prop("checked",true);
                $('.permsitem').prop("disabled",true);
            }
            $('.permsallmethod').each(function(){
                var sbitems = $(this).parents('table').find("table input.permsitem");
                if($(this).is(":checked")===true) {
                    sbitems.prop("checked",true);
                    sbitems.prop("disabled",true);
                }
            });
        });
    </script>
@endsection