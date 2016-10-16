@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('committee-members.panel-buttons.show')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('committee-members.view_committee_member', ['name' => $committeeMember->name])}}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <dl class="col-md-6">
                            <dt>{{trans('committee-members.occupation_id')}}</dt>
                            <dd>{{$committeeMember->occupation_id}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('committee-members.name')}}</dt>
                            <dd>{{$committeeMember->name}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('committee-members.company')}}</dt>
                            <dd>{{$committeeMember->company}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('committee-members.created_at')}}</dt>
                            <dd>{{$committeeMember->created_at}}</dd>
                        </dl>
                        <dl class="col-md-6">
                            <dt>{{trans('committee-members.updated_at')}}</dt>
                            <dd>{{$committeeMember->updated_at}}</dd>
                        </dl>
                    </div>
                </div>
                <div class="panel-footer">
                    {!! app('menu')->handler('committee-members.record-buttons.show')->render('inline') !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
