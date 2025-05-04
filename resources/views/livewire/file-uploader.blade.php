<div class="mt-10 p-6 space-y-4">
    <div class="pt-10">
        {{-- <form wire:submit.prevent="uploadSave" class="space-y-4">
            <input type="file" wire:model="file" class="border p-2 rounded w-full">
            @error('file') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Upload</button>
        </form> --}}
        <form wire:submit.prevent="uploadSave" class="space-y-2" wire:poll.2s>
            <div>
                <input type="file"
                       wire:model="file"
                       class="mb-2"
                       id="file-upload"
                       accept=".csv">
                <div wire:loading wire:target="file">
                    <span class="text-sm text-gray-500">Preparing file...</span>
                </div>
                @error('file')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                    wire:loading.attr="disabled"
                    wire:target="upload,file">
                <span wire:loading.remove wire:target="upload">Upload File</span>
                <span wire:loading wire:target="upload">Uploading...</span>
            </button>
        </form>

        <div class="mt-8">
            <table class="w-full text-sm text-left border border-gray-200" wire:poll.2s>
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Created at</th>
                        <th class="p-2">File Name</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uploads as $upload)
                        <tr class="border-t">
                            <td class="p-2">{{ $upload->created_at }}</td>
                            <td class="p-2">{{ $upload->filename }}</td>
                            <td class="p-2">
                                @if ($upload->status === 'processing')
                                    <span class="text-yellow-500">⏳ Processing</span>
                                @elseif ($upload->status === 'completed')
                                    <span class="text-green-600">✅ Completed</span>
                                @elseif ($upload->status === 'failed')
                                    <span class="text-red-600">❌ Failed</span>
                                @else
                                    <span class="text-gray-500">⏸ {{ ucfirst($upload->status) }}</span>
                                @endif
                            </td>
                            <td class="p-2">
                                <button wire:click="reupload({{ $upload->id }})"
                                        class="text-blue-600 hover:underline"
                                        wire:loading.attr="disabled"
                                        wire:target="reupload({{ $upload->id }})">
                                    <span wire:loading.remove wire:target="reupload({{ $upload->id }})">
                                        Reupload
                                    </span>
                                    <span wire:loading wire:target="reupload({{ $upload->id }})">
                                        Processing...
                                    </span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
