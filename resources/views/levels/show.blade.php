@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('levels.panel-buttons.show')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('levels.view_level', ['name' => $level->name])}}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <dl class="col-md-6">
                            <dt>{{trans('levels.occupation_id')}}</dt>
                            <dd>{{$level->occupation->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('levels.level')}}</dt>
                            <dd>{{$level->level}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('levels.name')}}</dt>
                            <dd>{{$level->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('levels.created_at')}}</dt>
                            <dd>{{$level->created_at}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('levels.updated_at')}}</dt>
                            <dd>{{$level->updated_at}}</dd>
                        </dl>
                    </div>
                </div>
                <div class="panel-footer">
                    {!! app('menu')->handler('levels.record-buttons.show')->render('inline') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
