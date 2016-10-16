@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('duties.panel-buttons.show')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('duties.view_duty', ['name' => $duty->name])}}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <dl class="col-md-6">
                            <dt>{{trans('duties.occupation_id')}}</dt>
                            <dd>{{$duty->occupation->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('duties.code')}}</dt>
                            <dd>{{$duty->code}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('duties.name')}}</dt>
                            <dd>{{$duty->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('duties.created_at')}}</dt>
                            <dd>{{$duty->created_at}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('duties.updated_at')}}</dt>
                            <dd>{{$duty->updated_at}}</dd>
                        </dl>
                    </div>
                </div>
                <div class="panel-footer">
                    {!! app('menu')->handler('duties.record-buttons.show')->render('inline') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
