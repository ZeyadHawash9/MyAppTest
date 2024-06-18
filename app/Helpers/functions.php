<?php

use Illuminate\Support\Facades\Storage;

function storePhoto($folder,  $image)
{
    $filename =  time() . '.' . $image->getClientOriginalExtension();

    $storagePath = Storage::disk('public')->path($folder);
    $image->move($storagePath, $filename);

    return $filename;
}

function message($status_code)
{
    switch ($status_code) {
        case 200:
            return 'Successfully Action';
        case 400:
            return 'Data not found.';
        case 401:
            return 'Invalid token.';
        case 404:
            return 'Invalid route.';
        case 422:
            return 'Client input error.';
        case 500:
            return 'Server error.';
    }
    return 'Sorry! You do not have permission.';
}

function response_api($status, $statusCode, $message = null, $object = null, $page_count = null, $page = null, $count = null, $errors = null, $another_data = null)
{

    $message = isset($message) ? $message : message($statusCode);
    $error = ['status' => false, 'statusCode' => $statusCode, 'message' => $message];
    $success = ['status' => true, 'statusCode' => $statusCode, 'message' => $message];

    // if ($status && isset($object)) {
    //     if (isset($page_count) && isset($page))
    //         $success['items'] = ['data' => $object, 'total_pages' => $page_count, 'current_page' => $page + 1, 'total_records' => $count];
    //     else
    //         $success['items'] = $object;
    // } else if (!$status && isset($errors))
    //     $error['errors'] = $errors;
    // else
    //     $success['items'] = null;


    // if (isset($another_data))
    //     foreach ($another_data as $key => $value)
    //         $success['items'][$key] = $value;

    $response = ($status) ? $success : $error;


    return response()->json($response);
}
