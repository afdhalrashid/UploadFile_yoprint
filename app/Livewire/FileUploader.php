<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessFileUpload;

class FileUploader extends Component
{
    use WithFileUploads;

    public $file = null;
    public $uploads = [];
    public $isUploading = false;

    public function mount()
    {
        $this->uploads = Upload::latest()->get();
    }

    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|file|max:40960'
        ]);
    }

    public function uploadSave()
    {
        if (!$this->file) {
            logger()->info('No file selected for upload.');
            return;
        }

        $this->validate([
            'file' => 'required|file|max:40960'
        ]);

        try {
            logger()->info('File upload started: ' . $this->file->getClientOriginalName());
            $this->isUploading = true;

            $path = $this->file->store('uploads');

            $upload = Upload::create([
                'filename' => $this->file->getClientOriginalName(),
                'path' => $path,
                'status' => 'pending',
            ]);

            ProcessFileUpload::dispatch($upload);

            $this->file = null;
            $this->uploads = Upload::latest()->get();

        } catch (\Exception $e) {
            logger()->error('File upload failed: ' . $e->getMessage());
            session()->flash('error', 'File upload failed. Please try again.' . $e->getMessage());
        } finally {
            $this->isUploading = false;
        }
    }

    public function reupload($uploadId)
    {
        $upload = Upload::find($uploadId);

        if ($upload) {
            $upload->update(['status' => 'pending']);
            ProcessFileUpload::dispatch($upload);
            $this->uploads = Upload::latest()->get();
        }
    }

    public function render()
    {
        return view('livewire.file-uploader')->layout('layouts.app');
    }
}
