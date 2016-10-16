@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('duties.panel-buttons.edit')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('duties.update_duty', ['name' => $duty->name])}}
                    </h4>
                </div>
                {!! Former::open(action('DutiesController@update', ['occupations' => $occupation->getSlug(), 'duties' => $duty->getSlug()])) !!}
                {!! Former::populate($duty) !!}
                    {!! Former::hidden('_method', 'PUT') !!}
                    <div class="panel-body">
                        @include('duties.form')
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary">{{trans('duties.submit')}}</button>
                        {!! app('menu')->handler('duties.record-buttons.edit')->render('inline') !!}
                        <div class="clearfix"></div>
                    </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
