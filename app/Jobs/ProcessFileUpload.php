<?php
namespace App\Jobs;

use App\Models\Upload;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use App\Service\CsvImportService;

class ProcessFileUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $upload;

    public function __construct(Upload $upload)
    {
        $this->upload = $upload;
    }

    public function handle()
    {
        $this->upload->update(['status' => 'processing']);
        logger()->info('Processing file: ' . $this->upload->filename);
        // sleep(3);
        $importService = App::make(CsvImportService::class);
        logger()->info('Parsing file: ' . $this->upload->filename);

        $success = $importService->parseAndUpsert($this->upload->path);

        $this->upload->update(['status' => 'completed']);
    }
}
