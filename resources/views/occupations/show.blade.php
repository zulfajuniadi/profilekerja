@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('occupations.panel-buttons.show')->render('inline') !!}
                    <h4>
                        {{trans('occupations.view_occupation', ['name' => $occupation->name])}}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <dl class="col-md-6">
                            <dt>{{trans('occupations.name')}}</dt>
                            <dd>{{$occupation->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('occupations.created_at')}}</dt>
                            <dd>{{$occupation->created_at}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('occupations.updated_at')}}</dt>
                            <dd>{{$occupation->updated_at}}</dd>
                        </dl>
                    </div>
                </div>
                <div class="panel-footer">
                    {!! app('menu')->handler('occupations.record-buttons.show')->render('inline') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
