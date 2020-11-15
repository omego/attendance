<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'attendance');

// Project repository
set('repository', 'https://github.com/omego/attendance.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
// set('allow_anonymous_stats', false);

// Hosts

// host('project.com')
//     ->set('deploy_path', '~/{{application}}');    

host('production')
    ->hostname('68.183.60.58')
    ->user('deployer')
    ->stage('production')
    ->set('branch', 'master')
    // ->user('production_user')
    ->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '/var/www/attendance')
;

host('staging')
    ->hostname('68.183.60.58')
    ->stage('staging')
    ->set('branch', 'dev')
    ->user('deployer')
    ->identityFile('~/.ssh/deployerkey')
    ->set('deploy_path', '/var/www/attend')
;

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('artisan:optimize', function () {});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

// before('deploy:symlink', 'artisan:migrate');

