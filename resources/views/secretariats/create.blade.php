@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('secretariats.panel-buttons.create')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('secretariats.create_new_secretariat')}}
                    </h4>
                </div>
                {!! Former::open(action('SecretariatsController@store', ['occupations' => $occupation->getSlug()])) !!}
                <div class="panel-body">
                    @include('secretariats.form')
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary">{{trans('secretariats.submit')}}</button>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
