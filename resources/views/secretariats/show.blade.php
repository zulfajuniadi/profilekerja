@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('secretariats.panel-buttons.show')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('secretariats.view_secretariat', ['name' => $secretariat->name])}}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <dl class="col-md-6">
                            <dt>{{trans('secretariats.occupation_id')}}</dt>
                            <dd>{{$secretariat->occupation_id}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('secretariats.role')}}</dt>
                            <dd>{{$secretariat->role}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('secretariats.name')}}</dt>
                            <dd>{{$secretariat->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('secretariats.created_at')}}</dt>
                            <dd>{{$secretariat->created_at}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('secretariats.updated_at')}}</dt>
                            <dd>{{$secretariat->updated_at}}</dd>
                        </dl>
                    </div>
                </div>
                <div class="panel-footer">
                    {!! app('menu')->handler('secretariats.record-buttons.show')->render('inline') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
