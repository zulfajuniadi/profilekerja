@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('duties.panel-buttons.create')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('duties.create_new_duty')}}
                    </h4>
                </div>
                {!! Former::open(action('DutiesController@store', ['occupations' => $occupation->getSlug()])) !!}
                <div class="panel-body">
                    @include('duties.form')
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary">{{trans('duties.submit')}}</button>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
