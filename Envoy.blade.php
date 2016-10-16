@servers(['web' => 'do04', 'local' => '127.0.0.1'])

{{-- @task('branchproduction', ['on' => 'local'])
    cd /private/var/www/cloudhrd.dev/
    git checkout production
    git merge master
    git push
@endtask --}}

 @task('push', ['on' => 'local'])
    git push
@endtask

@task('deploylive', ['on' => 'web'])
    cd /var/www/profilekerja.com
    ./deploy
@endtask

@macro('deploy')
    push
    deploylive
    {{-- branchmaster --}}
@endmacro
