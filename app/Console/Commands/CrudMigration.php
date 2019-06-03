<?php
/**
 * Created by PhpStorm.
 * User: Dário Santos
 * Date: 30/05/19
 * Time: 10:40
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CrudMigration extends Command
{
    use CrudGeneratorInterface;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:migration
    {name : Class (singular) por exemplo User}
    {--table-name= : Nome ta tabela (singular) por exemplo user}
    {--attributes=* : Nome dos atributos (singular) por exemplo id}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação da migration';

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
        $atributes = $this->option('attributes');
        $tableName = $this->option('table-name');
        Artisan::call("make:migration create_{$tableName} --create={$tableName}");
        $migration = trim(explode(':', Artisan::output())[1]);
        $file = database_path("migrations/{$migration}.php");
        $content = file($file);
        foreach ($content as $lineNumber => &$lineContent) {
            if ($lineNumber != 16) {
                continue;
            }
            foreach ($atributes as $attr) {
                if ($attr === 'id') {
                    continue;
                }
                $lineContent .= str_repeat(' ', 12) . "\$table->string('$attr');" . PHP_EOL;
            }
        }
        $allContent = implode("", $content);
        file_put_contents($file, $allContent);
    }
}
