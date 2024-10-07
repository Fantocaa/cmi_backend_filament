<?php

namespace App\Filament\Resources\ProductResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\ProductResource;
use Hashids\Hashids;

class PaginationHandler extends Handlers
{
    public static bool $public = true;
    public static string | null $uri = '/';
    public static string | null $resource = ProductResource::class;

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
        $hashids = new Hashids('', 24);  // 10 adalah panjang minimal

        // Transform the collection to only include the required fields
        $result = $query->getCollection()->transform(function ($item) use ($baseUrl, $hashids) {
            return [
                // 'id' => $item->id,
                'id' => $hashids->encode($item->id),
                'nama' => $item->nama,
                'deskripsi' => $item->deskripsi,
                'spesifikasi' => $item->spesifikasi,
                'image' => array_map(function ($img) use ($baseUrl) {
                    return $baseUrl . $img;
                }, $item->image),
                'category_id' => $item->category->id,
                'category_name' => $item->category->nama,
            ];
        });

        // Return the paginated result with the transformed collection
        return response()->json([
            'data' => $result,
        ]);
    }
}
