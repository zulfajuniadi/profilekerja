@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('tasks.panel-buttons.show')->render('inline') !!}
                    <h4>
                        {{$task->name}}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.duty_id')}}</dt>
                            <dd>{{$task->duty->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.code')}}</dt>
                            <dd>{{$task->code}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.level_id')}}</dt>
                            <dd>{{$task->level->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.name')}}</dt>
                            <dd>{{$task->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.subtasks')}}</dt>
                            <dd>{!! nl2br($task->subtasks) !!}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.performance_standard')}}</dt>
                            <dd>{!! nl2br($task->performance_standard) !!}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.enabling_requirement')}}</dt>
                            <dd>{!! nl2br($task->enabling_requirement) !!}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.materials')}}</dt>
                            <dd>{!! nl2br($task->materials) !!}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.created_at')}}</dt>
                            <dd>{{$task->created_at}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('tasks.updated_at')}}</dt>
                            <dd>{{$task->updated_at}}</dd>
                        </dl>
                    </div>
                </div>
                <div class="panel-footer">
                    {!! app('menu')->handler('tasks.record-buttons.show')->render('inline') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
