{!! Former::select('level_id')
    ->options(\App\Level::options())
    ->label('tasks.level_id')
    ->required() !!}
{!! Former::text('code')
    ->label('tasks.code')
    ->required() !!}
{!! Former::text('name')
    ->label('tasks.name')
    ->required() !!}
{!! Former::textarea('subtasks')
    ->label('tasks.subtasks')
    ->addClass('has-wysiwyg')
    ->rows(8) !!}
{!! Former::textarea('performance_standard')
    ->label('tasks.performance_standard')
    ->addClass('has-wysiwyg')
    ->rows(8) !!}
{!! Former::textarea('enabling_requirement')
    ->label('tasks.enabling_requirement')
    ->addClass('has-wysiwyg')
    ->rows(8) !!}
{!! Former::textarea('materials')
    ->label('tasks.materials')
    ->addClass('has-wysiwyg')
    ->rows(8) !!}
