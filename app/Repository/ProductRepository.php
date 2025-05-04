<?php
namespace App\Repository;

use App\Models\Product;

class ProductRepository
{
    public function upsertByUniqueKey(array $data): void
    {
        if (empty($data['UNIQUE_KEY'])) return;

        Product::updateOrCreate(
            ['unique_key' => $data['UNIQUE_KEY']],
            [
                'product_title' => $data['PRODUCT_TITLE'] ?? null,
                'product_description' => $data['PRODUCT_DESCRIPTION'] ?? null,
                'style_number' => $data['STYLE#'] ?? null,
                'sanmar_mainframe_color' => $data['SANMAR_MAINFRAME_COLOR'] ?? null,
                'size' => $data['SIZE'] ?? null,
                'color_name' => $data['COLOR_NAME'] ?? null,
                'piece_price' => isset($data['PIECE_PRICE']) ? (float) $data['PIECE_PRICE'] : null,
            ]
        );
    }
}
