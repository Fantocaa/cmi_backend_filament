<?php

namespace App\Filament\Resources\ProjectResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\ProjectResource;

class PaginationHandler extends Handlers
{
    public static bool $public = true;
    public static string | null $uri = '/';
    public static string | null $resource = ProjectResource::class;


    public function handler()
    {
        $query = static::getEloquentQuery();
        $model = static::getModel();

        $query = QueryBuilder::for($query)
            ->allowedFields($model::$allowedFields ?? [])
            ->allowedSorts($model::$allowedSorts ?? [])
            ->allowedFilters($model::$allowedFilters ?? [])
            ->allowedIncludes($model::$allowedIncludes ?? null)
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        // return static::getApiTransformer()::collection($query);

        // Get the base URL from the configuration
        $baseUrl = config('app.url') . '/storage/';

        // // Transform the collection to only include the required fields
        $result = $query->getCollection()->transform(function ($item) use ($baseUrl) {
            return [
                'id' => $item->id,
                // 'image_name' => $item->image_name
                'image_name' => is_array($item->image_name)
                    ? array_map(function ($img) use ($baseUrl) {
                        return $baseUrl . $img;
                    }, $item->image_name)
                    : [],
            ];
        });

        return response()->json([
            'data' => $result,
        ]);
    }
}
