<?php

namespace JoeriAbbo\LaravelApiMarkdownTree;

use Illuminate\Support\ServiceProvider;

class LaravelApiMarkdownTreeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateApiDocsCommand::class,
            ]);
        }
    }
}

