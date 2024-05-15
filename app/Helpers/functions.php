<?php

use Illuminate\Support\Facades\Storage;

function storePhoto($folder,  $image)
{
    $filename =  time() . '.' . $image->getClientOriginalExtension();

    $storagePath = Storage::disk('public')->path($folder);
    $image->move($storagePath, $filename);

    return $filename;
}
