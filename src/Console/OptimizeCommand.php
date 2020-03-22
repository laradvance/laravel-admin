<?php

namespace Encore\Admin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OptimizeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'admin:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize Application';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (! $this->confirm('Have you run composer install --optimize-autoloader --no-dev ?')) {
            return;
        }
        $this->removeFilesAndDirectories();
        $this->removeHelpers();
        $this->resetSessions();
        $this->call('config:cache');
        $this->call('view:cache');
        $this->line('<info>Deployment Successful!</info>');
        if (! $this->confirm('Want to optimize Route Loading?')) {
            return;
        }
        $this->call('route:cache');
    }

    /**
     * Remove files and directories.
     *
     * @return void
     */
    protected function removeFilesAndDirectories()
    {
        $this->laravel['files']->deleteDirectory(base_path('tests'));
        $this->laravel['files']->deleteDirectory(storage_path('debugbar'));
        $this->laravel['files']->deleteDirectory(storage_path('framework/sessions'));
        $this->laravel['files']->deleteDirectory(public_path('upload'));
        $this->laravel['files']->delete(base_path('.editorconfig'));
        $this->laravel['files']->delete(base_path('.env.example'));
        $this->laravel['files']->delete(base_path('.gitattributes'));
        $this->laravel['files']->delete(base_path('.gitignore'));
        $this->laravel['files']->delete(base_path('.styleci.yml'));
        $this->laravel['files']->delete(base_path('.travis.yml'));
        $this->laravel['files']->delete(base_path('LICENSE'));
        $this->laravel['files']->delete(base_path('README.md'));
        $this->laravel['files']->delete(base_path('phpunit.xml.dist'));        
        $this->laravel['files']->delete(base_path('phpunit.xml'));
    }

    /**
     * Remove Helpers Menu.
     *
     * @return void
     */
    protected function removeHelpers()
    {
        DB::table(config('admin.database.menu_table'))->where('title', '=', 'Helpers')->delete();
        DB::table(config('admin.database.menu_table'))->where('uri', 'like', 'helpers/%')->delete();
        DB::table(config('admin.database.permissions_table'))->where('slug', '=', 'ext.helpers')->delete();
    }

    /**
     * Remove Helpers Menu.
     *
     * @return void
     */
    protected function resetSessions()
    {
        $this->laravel['files']->makeDirectory(storage_path('framework/sessions'), 0755, true, true);
    }
}
