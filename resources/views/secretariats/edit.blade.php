@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('secretariats.panel-buttons.edit')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('secretariats.update_secretariat', ['name' => $secretariat->name])}}
                    </h4>
                </div>
                {!! Former::open(action('SecretariatsController@update', ['occupations' => $occupation->getSlug(), 'secretariats' => $secretariat->getSlug()])) !!}
                {!! Former::populate($secretariat) !!}
                    {!! Former::hidden('_method', 'PUT') !!}
                    <div class="panel-body">
                        @include('secretariats.form')
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary">{{trans('secretariats.submit')}}</button>
                        {!! app('menu')->handler('secretariats.record-buttons.edit')->render('inline') !!}
                        <div class="clearfix"></div>
                    </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
