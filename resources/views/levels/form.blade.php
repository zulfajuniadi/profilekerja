{!! Former::select('level')
    ->options(\App\Occupation::LevelOptions())
    ->label('levels.level')
    ->required() !!}
{!! Former::text('name')
    ->label('levels.name')
    ->required() !!}
