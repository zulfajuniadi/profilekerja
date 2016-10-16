@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {!! app('menu')->handler('duties.panel-buttons')->render('inline') !!}
                    <h4>
                        {{trans('duties.duties')}}
                    </h4>
                </div>
                <div class="panel-body">
                    @foreach($occupation->duties()->orderBy('code')->get() as $duty)
                        <div class="row">
                            <div class="col-md-2">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        {{$duty->code}}
                                    </div>
                                    <div class="panel-body">
                                        <a href="{{action('DutiesController@show', ['occupation' => $occupation->getSlug(), 'duty' => $duty->getSlug()])}}">{{$duty->name}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                @foreach($duty->tasks()->orderBy('code')->get()->chunk(4) as $tasks)
                                <div class="row">
                                    @foreach($tasks as $task)
                                    <div class="col-md-3">
                                        @if($task->level->level == 'L1')
                                        <div class="panel panel-info">
                                        @elseif($task->level->level == 'L2')
                                        <div class="panel panel-warning">
                                        @else
                                        <div class="panel panel-danger">
                                        @endif
                                            <div class="panel-heading">
                                                {{$task->code}}
                                                @if($task->level->level == 'L1')
                                                <span data-toggle="tooltip" title="{{$task->level->name}}" class="label label-info pull-right">
                                                @elseif($task->level->level == 'L2')
                                                <span data-toggle="tooltip" title="{{$task->level->name}}" class="label label-warning pull-right">
                                                @else
                                                <span data-toggle="tooltip" title="{{$task->level->name}}" class="label label-danger pull-right">
                                                @endif
                                                    {{$task->level->level}}
                                                </span>
                                            </div>
                                            <div class="panel-body">
                                                <a href="{{action('TasksController@show', ['duties' => $duty->getSlug(), 'tasks' => $task->slug])}}">
                                                    {{$task->name}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-md-12">
                                    <br>
                                    @if($occupation->levels->count() > 0)
                                    <a class="btn btn-primary" href="{{action('TasksController@create', ['duty' => $duty->getSlug()])}}">
                                        Add New Task
                                    </a>
                                    @else
                                        Add new levels first
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <a class="btn btn-primary" href="{{action('DutiesController@create', ['occupations' => $occupation->getSlug()])}}">New Duty</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip();
</script>
@endsection
