<?php
namespace App\Filament\Resources\ImageHomeResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ImageHomeResource;
use Illuminate\Routing\Router;


class ImageHomeApiService extends ApiService
{
    protected static string | null $resource = ImageHomeResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
