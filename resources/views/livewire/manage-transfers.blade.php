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
    <tbody class="bg-white divide-y divide-gray-200">
    <tr>
      <td class="px-6 py-4 whitespace-nowrap">√</td>
      <td class="px-6 py-4 whitespace-nowrap">Uploaded</td>
      <td class="px-6 py-4 whitespace-nowrap">d9cbb5a7-ea12-42b4-9fb3-3e5a7f10631f</td>
      <td class="px-6 py-4 whitespace-nowrap">2MB</td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap">X</td>
      <td class="px-6 py-4 whitespace-nowrap">Finished with errors</td>
      <td class="px-6 py-4 whitespace-nowrap">0d669854-fb2c-480f-ae04-8572ec695242</td>
      <td class="px-6 py-4 whitespace-nowrap">0MB</td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap">!!</td>
      <td class="px-6 py-4 whitespace-nowrap">Failed</td>
      <td class="px-6 py-4 whitespace-nowrap">e176a925-8534-446f-a1f6-3fc2e06fcb0f</td>
      <td class="px-6 py-4 whitespace-nowrap">0MB</td>
    </tr>
    <tr>
      <td class="px-6 py-4 whitespace-nowrap">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle stroke-width="4"></circle>
          <path
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex h-2 overflow-hidden rounded bg-gray-50">
          <div style="transform: scale({{ 50 / 100 }}, 1)"
               class="bg-indigo-500 transition-transform origin-left duration-200 ease-in-out w-full shadow-none flex flex-col"></div>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        296fc64e-af31-401d-9895-3d18ce02931c
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        0MB
      </td>
    </tr>
    </tbody>
  </table>


  <div class=" shadow border-b border-gray-200 sm:rounded-lg bg-white p-2 ml-2">
    <h3 class="text-lg font-bold">Create Batch</h3>
    <p>Select the files you want to upload.</p>

    <div class="form-control">
      <input id="files" wire:model="pendingFiles"  name="files" type="file" multiple wire class="border w-full">
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