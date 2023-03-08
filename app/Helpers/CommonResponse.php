<?php

namespace App\Helpers;

class CommonResponse {
    public static function notFoundResponse() {
        return ResponseHelper::send(
            [],
            Status::NOT_GOOD,
            HttpCode::NOT_FOUND,
            ErrorCodeHelper::NOT_FOUND
        );
    }
    public static function deleteSuccessfullyResponse() {
        return ResponseHelper::send(
            ['message'=>'Delete successfully'],
            Status::OK,
            HttpCode::OK,
        );
    }

    public static function existedResponse($type) {
        return ResponseHelper::send(
            [],
            Status::NOT_GOOD,
            HttpCode::CONFLICT,
            ErrorCodeHelper::EXISTED . ' ' . $type
        );
    }

    public static function missingResponse($type) {
        return ResponseHelper::send(
            [],
            Status::NOT_GOOD,
            HttpCode::BAD_REQUEST,
            ErrorCodeHelper::MISSING . ' ' . $type
        );
    }

    public static function invalidResponse($type) {
        return ResponseHelper::send(
            [],
            Status::NOT_GOOD,
            HttpCode::BAD_REQUEST,
            ErrorCodeHelper::INVALID . ' ' . $type
        );
    }

    public static function forbiddenResponse() {
        return ResponseHelper::send(
            [],
            Status::NOT_GOOD,
            HttpCode::FORBIDDEN,
            ErrorCodeHelper::NOT_ALLOW
        );
    }

    public static function unknownResponse() {
        return ResponseHelper::send([], Status::NOT_GOOD);
    }
}
