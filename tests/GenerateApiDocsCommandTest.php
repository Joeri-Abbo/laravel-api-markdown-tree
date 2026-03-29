<?php

namespace JoeriAbbo\LaravelApiMarkdownTree\Tests;

use JoeriAbbo\LaravelApiMarkdownTree\LaravelApiMarkdownTreeServiceProvider;
use Orchestra\Testbench\TestCase;

class GenerateApiDocsCommandTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [LaravelApiMarkdownTreeServiceProvider::class];
    }

    public function test_command_is_registered(): void
    {
        $this->assertTrue(
            $this->app->make(\Illuminate\Contracts\Console\Kernel::class)
                ->all()['apidocs:generate'] instanceof \JoeriAbbo\LaravelApiMarkdownTree\GenerateApiDocsCommand
        );
    }

    public function test_command_generates_output_file(): void
    {
        $outputPath = sys_get_temp_dir() . '/test_api_docs_' . uniqid() . '.md';

        $this->artisan('apidocs:generate', ['output' => $outputPath])
            ->assertExitCode(0);

        $this->assertFileExists($outputPath);

        unlink($outputPath);
    }
}
