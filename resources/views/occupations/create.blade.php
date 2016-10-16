@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('occupations.panel-buttons.create')->render('inline') !!}
                    <h4>
                        {{trans('occupations.create_new_occupation')}}
                    </h4>
                </div>
                {!! Former::open(action('OccupationsController@store')) !!}
                <div class="panel-body">
                    @include('occupations.form')
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary">{{trans('occupations.submit')}}</button>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
