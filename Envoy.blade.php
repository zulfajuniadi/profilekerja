@servers(['web' => 'do04', 'local' => '127.0.0.1'])

{{-- @task('branchproduction', ['on' => 'local'])
    cd /private/var/www/cloudhrd.dev/
    git checkout production
    git merge master
    git push
@endtask

@task('branchmaster', ['on' => 'local'])
    git checkout master
    git merge production
    git push
    cd /private/var/www/cloudhrd.dev/web/app
@endtask --}}

@task('deploylive', ['on' => 'web'])
    cd /var/www/profilekerja.com
    ./deploy
@endtask

@macro('deploy')
    {{-- branchproduction --}}
    deploylive
    {{-- branchmaster --}}
@endmacro
