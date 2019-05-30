<?php
/**
 * Created by PhpStorm.
 * User: Dário Santos
 * Date: 30/05/19
 * Time: 10:37
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CrudRoutes extends Command
{
    use CrudGeneratorInterface;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:routes
    {name : Nome do modulo (singular) por exemplo user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação das rotas basicas de um CRUD';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $nameSpace = str_replace('/', '\\', $name);
        $prefix = explode('/', $name);
        $nameClass = end($prefix);
        $prefixStrtolower = strtolower($nameClass);
        $route = "
Route::group(['prefix' => '{$prefixStrtolower}'], function () {
    Route::get('/', '{$nameSpace}Controller@getAll{$nameClass}s');
    Route::get('/{id}', '{$nameSpace}Controller@get{$nameClass}ById');
    Route::post('/paginate/{totalPage?}', '{$nameSpace}Controller@getAll{$nameClass}sPaginate');
    Route::post('/', '{$nameSpace}Controller@create{$nameClass}');
    Route::patch('/{id}', '{$nameSpace}Controller@update{$nameClass}');
    Route::patch('/{id}/enable', '{$nameSpace}Controller@enable{$nameClass}');
    Route::patch('/{id}/disable', '{$nameSpace}Controller@disable{$nameClass}');
});
";
        File::append(base_path('routes/api.php'), $route);
    }
}
