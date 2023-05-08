<?php

namespace JoeriAbbo\LaravelApiMarkdownTree;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class GenerateApiDocsCommand extends Command
{
    protected $signature = 'apidocs:generate {output=api_docs.md}';
    protected $description = 'Generate API documentation in tree view Markdown format';

    public function handle()
    {
        $routes = Route::getRoutes();
        $tree = ['routes' => [], 'children' => []];

        foreach ($routes as $route) {
            $uriSegments = explode('/', $route->uri());
            $routeInfo = [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri()
            ];

            $this->addToTree($tree, $uriSegments, $routeInfo);
        }

        $markdownOutput = $this->generateTreeView($tree);
        $outputPath = $this->argument('output');
        file_put_contents($outputPath, $markdownOutput);

        $this->info("API documentation generated and saved to {$outputPath}");
    }

    private function addToTree(array &$tree, array $segments, $routeInfo)
    {
        if (empty($segments)) {
            $tree['routes'][] = $routeInfo;
            return;
        }

        $segment = array_shift($segments);

        if (!isset($tree['children'][$segment])) {
            $tree['children'][$segment] = ['routes' => [], 'children' => []];
        }

        $this->addToTree($tree['children'][$segment], $segments, $routeInfo);
    }

    private function generateTreeView(array $tree, $depth = 0)
    {
        $output = '';

        foreach ($tree['children'] as $segment => $node) {
            $padding = str_repeat('  ', $depth);
            $output .= "{$padding}- {$segment}\n";

            foreach ($node['routes'] as $routeInfo) {
                $output .= "{$padding}  - [{$routeInfo['method']}] {$routeInfo['uri']}\n";
            }

            $output .= $this->generateTreeView($node, $depth + 1);
        }

        return $output;
    }
}
