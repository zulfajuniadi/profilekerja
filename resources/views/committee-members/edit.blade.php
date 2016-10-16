@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('committee-members.panel-buttons.edit')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('committee-members.update_committee_member', ['name' => $committeeMember->name])}}
                    </h4>
                </div>
                {!! Former::open(action('CommitteeMembersController@update', ['occupations' => $occupation->getSlug(), 'committee_members' => $committeeMember->getSlug()])) !!}
                {!! Former::populate($committeeMember) !!}
                    {!! Former::hidden('_method', 'PUT') !!}
                    <div class="panel-body">
                        @include('committee-members.form')
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary">{{trans('committee-members.submit')}}</button>
                        {!! app('menu')->handler('committee-members.record-buttons.edit')->render('inline') !!}
                        <div class="clearfix"></div>
                    </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
