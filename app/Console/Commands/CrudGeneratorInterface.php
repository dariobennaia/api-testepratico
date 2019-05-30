<?php
/**
 * Created by PhpStorm.
 * User: Dário Santos
 * Date: 30/05/19
 * Time: 10:38
 */

namespace App\Console\Commands;

trait CrudGeneratorInterface
{
    private function getAttributesPath()
    {
        $name = $this->argument('name');
        $classPath = explode('/', $name);
        $className = array_pop($classPath);
        $nameSpaceClass = !empty($classPath) ? implode('\\', $classPath) : null;
        $pathClassa = !empty($classPath) ? implode('/', $classPath) : null;

        return [
            'name_space_class' => '\\' . $nameSpaceClass,
            'name_space_use_class' => !is_null($nameSpaceClass) ? $nameSpaceClass . '\\' : null,
            'class_name' => $className,
            'path_class' => $pathClassa,
        ];
    }

    private function createClass($path, $type, $attributesClass)
    {
        $attributesPath = $this->getAttributesPath();

        if (!is_dir(app_path("{$path}/{$attributesPath['path_class']}"))) {
            mkdir(app_path("{$path}/{$attributesPath['path_class']}"), 0777, true);
        }

        file_put_contents(
            app_path("{$path}/{$attributesPath['path_class']}/{$attributesPath['class_name']}{$type}.php"),
            $attributesClass
        );
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
}
