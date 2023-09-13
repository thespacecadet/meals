<?php

namespace App\Services;
use PHPHtmlParser\Dom;
class ParseMealPlan
{
    private Dom $dom;

    public function __construct()
{
    $this->dom = new Dom();
}
}
