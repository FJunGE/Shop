<?php
/**
 * Created by PhpStorm.
 * User: crazy
 * Date: 2019/7/12
 * Time: 11:43
 */

function test_helper()
{
    return "OK";
}

function route_class()
{
    return str_replace('.','-', Route::currentRouteName());
}