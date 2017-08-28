<?php

namespace App\Helpers;

class RESTAPIHelper {

    public static function response($output, $status = 'Success', $dev_message = '', $format = 'json') {

        $response = [
            'Response' => $status ? 'Success' : 'Error'
        ];

        $response['Message'] = $dev_message;
        $response['Response'] = $status;
        $response['Result'] = $output;

        return response()->json($response);
    }

    public static function emptyResponse($status = true, $dev_message = '', $format = 'json') {

        $response = [
            'status' => $status ? true : false
        ];

        if (!$status) {
            $response['error_code'] = $dev_message;
        }

        return response()->json($response);
    }

}
