<div class="container mx-auto grid grid-cols-4 gap-4">
  <table class="col-span-3 h-auto  shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
    <thead class="bg-gray-50">
    <tr>
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">&nbsp;</th>
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch ID
      </th>
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Storage
      </th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200"
    @forelse($transfers as $transfer)
      <tr class="bg-white">
        @if(is_null($transfer->jobBatch))

          <td>
            %
          </td>
          <td>
            <div class="flex h-2 overflow-hidden rounded bg-gray-50">
              <div style="transform: scale(0, 1)"
                   class="bg-indigo-500 transition-transform origin-left duration-200 ease-in-out w-full shadow-none flex flex-col"></div>
            </div>
          </td>
        @elseif($transfer->jobBatch->hasPendingJobs())
          <td>
            %
          </td>
          <td>
            <div class="flex h-2 overflow-hidden rounded bg-gray-50">
              <div style="transform: scale({{ $transfer->jobBatch->progress() / 100 }}, 1)"
                   class="bg-indigo-500 transition-transform origin-left duration-200 ease-in-out w-full shadow-none flex flex-col"></div>
            </div>
          </td>

        @elseif($transfer->jobBatch->finished() and $transfer->jobBatch->failed())

          <td>
            X
          </td>
          <td>
            Failed
          </td>

        @elseif($transfer->jobBatch->finished() and $transfer->jobBatch->hasFailures())

          <td>
            !!
          </td>
          <td>
            Finished with errors
          </td>

        @elseif($transfer->jobBatch->finished())

          <td>
            √
          </td>
          <td>
            Uploaded
          </td>
        @endif
        <td>
          {{ $transfer->batch_id }}
        </td>
        <td>
          {{-- combined file size of transfer files --}}
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="4">
          You have no transfers. Create a batch on the right 👉🏻
        </td>
      </tr>
      @endforelse
      </tbody>
  </table>


  <div class=" shadow border-b border-gray-200 sm:rounded-lg bg-white p-2 ml-2">
    <h3 class="text-lg font-bold">Create Batch</h3>
    <p>Select the files you want to upload.</p>

    <div class="form-control">
      <input id="files" wire:model="pendingFiles" name="files" type="file" multiple wire class="border w-full">
    </div>

    <div class="bor">
      Files
    </div>


    <div>
      <div>
        @forelse($pendingFiles as $pendingFile)
          <img src="{{ $pendingFile->temporaryUrl() }}"
               alt="">
        @empty
          <p>No files selected</p>
        @endforelse
      </div>
    </div>

    <div>
      @error('pendingFiles.*')
      {{ $message }}
      @enderror
    </div>

    <div>
      <button type="button" wire:click="initiateTransfer">
        Do some magic

        <svg xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
        </svg>
      </button>
    </div>
  </div>
</div>