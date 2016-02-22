<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 22/02/2016
 * Time: 17.56
 */

namespace App\Models;

interface SluggableInterface
{
    public function getSlug();
    public function sluggify($force = false);
    public function resluggify();
}