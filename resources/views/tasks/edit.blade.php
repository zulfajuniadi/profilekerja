@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('tasks.panel-buttons.edit')->render('inline') !!}
                    <h4>
                        {{$duty->name}}: {{trans('tasks.update_task', ['name' => $task->name])}}
                    </h4>
                </div>
                {!! Former::open(action('TasksController@update', ['duties' => $duty->getSlug(), 'tasks' => $task->getSlug()])) !!}
                {!! Former::populate($task) !!}
                    {!! Former::hidden('_method', 'PUT') !!}
                    <div class="panel-body">
                        @include('tasks.form')
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary">{{trans('tasks.submit')}}</button>
                        {!! app('menu')->handler('tasks.record-buttons.edit')->render('inline') !!}
                        <div class="clearfix"></div>
                    </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
