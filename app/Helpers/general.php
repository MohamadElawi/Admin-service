<?php


function success($message):\Illuminate\Http\Response
{
    return response([
        'success'=>true,
        'message'=>$message,
    ],200);
}

function failure($message,$status):\Illuminate\Http\Response
{
    return response([
        'success'=>false,
        'message'=>$message,
    ],$status);
}

 function returnData($key, $value, $message = ""): \Illuminate\Http\Response
{
    return response([
        'success' => true,
        'message' => $message,
        $key => $value
    ],200);
}
