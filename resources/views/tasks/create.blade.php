@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('tasks.panel-buttons.create')->render('inline') !!}
                    <h4>
                        {{$duty->name}}: {{trans('tasks.create_new_task')}}
                    </h4>
                </div>
                {!! Former::open(action('TasksController@store', ['duties' => $duty->getSlug()])) !!}
                <div class="panel-body">
                    @include('tasks.form')
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary">{{trans('tasks.submit')}}</button>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
