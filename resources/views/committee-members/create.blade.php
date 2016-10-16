@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('committee-members.panel-buttons.create')->render('inline') !!}
                    <h4>
                        {{$occupation->name}}: {{trans('committee-members.create_new_committee_member')}}
                    </h4>
                </div>
                {!! Former::open(action('CommitteeMembersController@store', ['occupations' => $occupation->getSlug()])) !!}
                <div class="panel-body">
                    @include('committee-members.form')
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary">{{trans('committee-members.submit')}}</button>
                </div>
                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
