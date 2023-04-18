<?php


function getUser()
{
    return auth()->guard('sanctum')->user();
}
