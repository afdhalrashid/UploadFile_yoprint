<?php
namespace App\Service;

use Illuminate\Support\Facades\Storage;
use App\Repository\ProductRepository;

class CsvImportService
{
    protected ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function parseAndUpsert(string $storagePath): bool
    {
        $fullPath = Storage::path($storagePath);
        if (!file_exists($fullPath)) return false;

        if (($handle = fopen($fullPath, 'r')) === false) return false;

        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            return false;
        }

        while (($row = fgetcsv($handle)) !== false) {
            $row = array_map(fn($field) => mb_convert_encoding($field, 'UTF-8', 'UTF-8'), $row);
            $data = array_combine($header, $row);

            $this->products->upsertByUniqueKey($data);
        }

        fclose($handle);
        return true;
    }
}
