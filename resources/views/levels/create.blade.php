@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('levels.panel-buttons.create')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('levels.create_new_level')}}
                    </h4>
                </div>
                {!! Former::open(action('LevelsController@store', ['occupations' => $occupation->getSlug()])) !!}
                <div class="panel-body">
                    @include('levels.form')
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary">{{trans('levels.submit')}}</button>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
