<?php

namespace Encore\Admin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeployCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'admin:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy Application';

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
        $this->call('route:cache');
        $this->call('view:cache');
        $this->line('<info>Deployment Successful!</info>');
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
        $this->laravel['files']->delete(base_path('LISENCE'));
        $this->laravel['files']->delete(base_path('README.md'));
        $this->laravel['files']->delete(base_path('phpunit.xml.dist'));
    }

    /**
     * Remove Helpers Menu.
     *
     * @return void
     */
    protected function removeHelper()
    {
        DB::table('admin_menu')->where('title', '=', 'Helpers')->delete();
        DB::table('admin_menu')->where('uri', 'like', 'helpers/%')->delete();
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
