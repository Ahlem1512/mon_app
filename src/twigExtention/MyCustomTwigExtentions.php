<?php

namespace App\twigExtention;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyCustomTwigExtentions extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('defaultImage', [$this, 'defaultImage']),
        ];
    }


    public function defaultImage(string $path):string{
        if(strlen(trim($path)) == 0){
            return 'as.jpg';
        }
        return $path;
    }
}