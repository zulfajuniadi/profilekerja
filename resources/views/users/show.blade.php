@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('users.panel-buttons.show')->render('inline') !!}
                    <h4>
                        {{trans('users.view_user', ['name' => $user->name])}}
                    </h4>
                </div>
                <div class="panel-body profile">
                    @include('users.profile-inner', compact('user'))
                </div>
                <div class="panel-footer">
                    {!! app('menu')->handler('users.record-buttons.show')->render('inline') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
