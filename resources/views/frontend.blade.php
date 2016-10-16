<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <!-- Search engines -->
    <meta name="description" content="Profile Kerja untuk Skills Malaysia">
    <!-- Google Plus -->
    <!-- Update your html tag to include the itemscope and itemtype attributes. -->
    <!-- html itemscope itemtype="http://schema.org/{CONTENT_TYPE}" -->
    <meta itemprop="name" content="Profile Kerja">
    <meta itemprop="description" content="Profile Kerja untuk Skills Malaysia">
    <meta itemprop="image" content="http://profilekerja.com/icon.png">
    <!-- Twitter -->
    <meta name="twitter:card" content="Profile Kerja">
    <meta name="twitter:site" content="@zuljzul">
    <meta name="twitter:title" content="Profile Kerja">
    <meta name="twitter:description" content="Profile Kerja untuk Skills Malaysia">
    <meta name="twitter:creator" content="@zuljzul">
    <meta name="twitter:image:src" content="http://profilekerja.com/icon.png">
    <meta name="twitter:player" content="">
    <!-- Open Graph General (Facebook & Pinterest) -->
    <meta property="og:url" content="http://profilekerja.com">
    <meta property="og:title" content="Profile Kerja">
    <meta property="og:description" content="Profile Kerja untuk Skills Malaysia">
    <meta property="og:site_name" content="Profile Kerja">
    <meta property="og:image" content="http://profilekerja.com/icon.png">
    <meta property="fb:admins" content="">
    <meta property="fb:app_id" content="">
    <meta property="og:type" content="">
    <meta property="og:locale" content="">
    <meta property="og:audio" content="">
    <meta property="og:video" content="">
    <title>{{ app('config')->get('app.name') }}</title>

    <link rel="stylesheet" href="{{ elixir("assets/build.css") }}">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <style type="text/css">
    .clickable {
        cursor: pointer
    }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <ui-view></ui-view>
        <script type="text/ng-template" id="occupations.html">
            <h2>
                Occupations
            </h2>
            <br>
            <div class="form-group">
                <input class="form-control input-lg" type="search" placeholder="Search Occupation" ng-model="search">
            </div>
            <hr>
            <div class="row" ng-repeat="occupations in occupations | chunk:4">
                <div class="col-md-3" ng-repeat="occupation in occupations | filter:{ name: search }">
                    <div class="panel panel-primary clickable" ui-sref="occupation({slug: occupation.slug})">
                        <div class="panel-heading">
                            @{{occupation.duties.length}} Duties
                        </div>
                        <div class="panel-body">
                            @{{occupation.name}}
                        </div>
                    </div>
                </div>
            </div>
        </script>
        <script type="text/ng-template" id="occupation.html">
            <h2>
                <button ui-sref="occupations" class="btn btn-primary pull-right">
                    Back
                </button>
                @{{occupation.name}}
            </h2>
            <br>
            <div class="form-group">
                <input class="form-control input-lg" type="search" placeholder="Search Tasks" ng-model="search">
            </div>
            <hr>
            <div class="row" ng-repeat="duty in occupation.duties" ng-show="(duty.tasks|filter:{name:search}).length > 0">
                <div class="col-md-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            @{{duty.code}}
                        </div>
                        <div class="panel-body">
                            @{{duty.name}}
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row" ng-repeat="tasks in duty.tasks | chunk:4">
                        <div class="col-md-3" ng-repeat="task in tasks | filter: { name: search }">
                            <div ui-sref="task({occupation_slug: occupation.slug, task_slug: task.slug})" class="panel clickable" ng-class="{'panel-info': (task.level.level == 'L1'),'panel-warning': (task.level.level == 'L2'),'panel-danger': (task.level.level == 'L3')}">
                                <div class="panel-heading">
                                    @{{task.code}}
                                    <span class="label pull-right" ng-class="{'label-info': (task.level.level == 'L1'),'label-warning': (task.level.level == 'L2'),'label-danger': (task.level.level == 'L3')}">
                                        @{{task.level.level}}
                                    </span>
                                </div>
                                <div class="panel-body">
                                    @{{task.name}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </script>
        <script type="text/ng-template" id="task.html">
            <h2>
                <button ui-sref="occupation({slug: occupation_slug})" class="btn btn-primary pull-right">
                    Back
                </button>
                @{{task.name}}
            </h2>
            <hr>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @{{task.name}} Task
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <b>Duty</b><br>
                            @{{task.duty.name}}
                        </div>
                        <div class="col-md-4">
                            <b>Code</b><br>
                            @{{task.code}}
                        </div>
                        <div class="col-md-4">
                            <b>Level</b><br>
                            @{{task.level.level}}:
                            @{{task.level.name}}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Performance Standard</b><br>
                            <div ng-bind-html="task.performance_standard | nl2br"></div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <b>Subtasks</b><br>
                            <div ng-bind-html="task.subtasks | nl2br"></div>
                        </div>
                        <div class="col-md-4">
                            <b>Enabling Requirements</b><br>
                            <div ng-bind-html="task.enabling_requirement | nl2br"></div>
                        </div>
                        <div class="col-md-4">
                            <b>Materials</b><br>
                            <div ng-bind-html="task.materials | nl2br"></div>
                        </div>
                    </div>
                </div>
            </div>
        </script>
    </div>
    <footer>
        <div class="container text-muted">
            <br>
            @if(!Auth::user())
            <a href="/auth/login" class="text-muted">Login</a>
            @else
            <a href="/occupations" class="text-muted">Manage Occupations</a> | <a href="/auth/logout" class="text-muted">Logout</a>
            @endif
        </div>
    </footer>
    <script type="text/javascript" src="/home.js"></script>
    <script type="text/javascript">
    angular.module('app', ['ui.router', 'ngSanitize', 'nl2br'])
        .filter('chunk', function () {
            function cacheIt(func) {
                cache = {};
                return function(arg) {
                    var key =  JSON.stringify(arg);
                    return cache[key] ? cache[key] : (cache[key] = func(arg));
                };
            }
            function chunk(items, chunk_size) {
                var chunks = [];
                if (angular.isArray(items)) {
                    if (isNaN(chunk_size))
                        chunk_size = 4;
                    for (var i = 0; i < items.length; i += chunk_size) {
                        chunks.push(items.slice(i, i + chunk_size));
                    }
                } else {
                    console.log("items is not an array: " + angular.toJson(items));
                }
                return chunks;
            }
            return cacheIt(chunk);
        })
        .config(function($stateProvider, $urlRouterProvider, $httpProvider){
            $httpProvider.defaults.cache = true;
            $stateProvider.state('occupations', {
                url: '/occupations',
                templateUrl: 'occupations.html',
                resolve: {
                    occupations: function($http) {
                        return $http.get('/home/occupations')
                            .then(function(response){
                                return response.data;
                            })
                    }
                },
                controller: function(occupations, $scope) {
                    $scope.search = '';
                    $scope.occupations = occupations;
                }
            }).state('occupation', {
                url: '/occupation/:slug',
                templateUrl: 'occupation.html',
                resolve: {
                    occupation: function($http, $stateParams) {
                        return $http.get('/home/occupation/' + $stateParams.slug)
                            .then(function(response){
                                return response.data;
                            })
                    }
                },
                controller: function(occupation, $scope) {
                    $scope.search = '';
                    $scope.occupation = occupation;
                }
            }).state('task', {
                url: '/occupation/:occupation_slug/:task_slug',
                templateUrl: 'task.html',
                resolve: {
                    task: function($http, $stateParams) {
                        return $http.get('/home/task/' + $stateParams.task_slug)
                            .then(function(response){
                                return response.data;
                            })
                    }
                },
                controller: function(task, $scope, $stateParams) {
                    $scope.task = task;
                    $scope.occupation_slug = $stateParams.occupation_slug;
                }
            });
            $urlRouterProvider.otherwise('/occupations');
        })
    </script>
</body>
</html>
