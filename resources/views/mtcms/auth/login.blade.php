@extends('sbadmin.login_layout')

@section('title')
    {{trans('app.name')}} - {{trans('app.userlogin')}}
@endsection

@section('content')

    <form role="form" method="post" action="{{ url('/auth/login') }}">
        <fieldset>

            @include('sbadmin/partial/inc_error')

            <div class="form-group">
                <input class="form-control" placeholder="{{trans('app.email')}}" name="email" type="email" autofocus required>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="{{trans('app.password')}}" name="password" type="password" value="" required>
            </div>
            <button type="submit" class="btn btn-lg btn-success btn-block">{{trans('app.login')}}</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </fieldset>
    </form>

@stop