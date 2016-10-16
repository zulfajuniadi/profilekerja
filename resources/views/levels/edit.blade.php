@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('levels.panel-buttons.edit')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('levels.update_level', ['name' => $level->name])}}
                    </h4>
                </div>
                {!! Former::open(action('LevelsController@update', ['occupations' => $occupation->getSlug(), 'levels' => $level->getSlug()])) !!}
                {!! Former::populate($level) !!}
                    {!! Former::hidden('_method', 'PUT') !!}
                    <div class="panel-body">
                        @include('levels.form')
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary">{{trans('levels.submit')}}</button>
                        {!! app('menu')->handler('levels.record-buttons.edit')->render('inline') !!}
                        <div class="clearfix"></div>
                    </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
