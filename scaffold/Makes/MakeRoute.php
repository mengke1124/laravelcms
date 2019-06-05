<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace Cms\Generator\Makes;

use Illuminate\Filesystem\Filesystem;
use Cms\Generator\Commands\ScaffoldMakeCommand;
use Cms\Generator\Migrations\SchemaParser;
use Cms\Generator\Migrations\SyntaxBuilder;

class MakeRoute
{
    use MakerTrait;

    /**
     * Create a new instance.
     *
     * @param ScaffoldMakeCommand $scaffoldCommand
     * @param Filesystem $files
     * @return void
     */
    public function __construct(ScaffoldMakeCommand $scaffoldCommand, Filesystem $files)
    {
        $this->files = $files;
        $this->scaffoldCommandObj = $scaffoldCommand;

        $this->start();
    }

    /**
     * Start make controller.
     *
     * @return void
     */
    private function start()
    {
        $name = $this->scaffoldCommandObj->getObjName('Name');
        $route_name = floatval(app()::VERSION) < 5.3 ? 'route_old' : 'route';
        $path = $this->getPath($name, $route_name);
        $stub = $this->compileRouteStub();

        $content = $this->files->get($path);
        
        if (strpos($content, $stub) === false) {

            if (strpos($content, '#Append Route') === false) { 
               $this->files->append($path, $stub);   
            }else{
               $content = str_replace("#Append Route", $stub, $content);
               $this->files->put($path, $content);  
            }

            return $this->scaffoldCommandObj->info('+ ' . $path . ' (Updated)');
        }
        
        return $this->scaffoldCommandObj->comment("x $path" . ' (Skipped)');
    }

    /**
     * Compile the migration stub.
     *
     * @return string
     */
    protected function compileRouteStub()
    {
        $stub = $this->files->get(substr(__DIR__,0, -5) . 'Stubs/route.stub');

        $this->buildStub($this->scaffoldCommandObj->getMeta(), $stub);

        return $stub;
    }
}
