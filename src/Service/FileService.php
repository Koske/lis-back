<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.3.18.
 * Time: 15.39
 */

namespace App\Service;


use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{
    private $filesystem;

    public function __construct(ContainerInterface $container)
    {
        $this->filesystem = $container->get('knp_gaufrette.filesystem_map')->get('app');
    }

    public function upload($content, $type, $context)
    {
        $name = md5(uniqid()).'.'.$type;

        if($this->filesystem->has($context.'/'.$name)) {
            return $name;
        }

        $this->filesystem->write($context.'/'.$name, $content);

        return $name;
    }

    public function uploadImage($path, $context) {

        $imageData = file_get_contents($path);
    }
}