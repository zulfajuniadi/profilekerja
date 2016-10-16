@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('occupations.panel-buttons.edit')->render('inline') !!}
                    <h4>
                        {{trans('occupations.update_occupation', ['name' => $occupation->name])}}
                    </h4>
                </div>
                {!! Former::open(action('OccupationsController@update', $occupation->getSlug())) !!}
                {!! Former::populate($occupation) !!}
                    {!! Former::hidden('_method', 'PUT') !!}
                <div class="panel-body">
                    @include('occupations.form')
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary">{{trans('occupations.submit')}}</button>
                    {!! app('menu')->handler('occupations.record-buttons.edit')->render('inline') !!}
                    <div class="clearfix"></div>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
