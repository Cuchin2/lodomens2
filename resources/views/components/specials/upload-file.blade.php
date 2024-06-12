 @props(['url'=>'','livewire'=>false])

<div x-data="imageData('{{ $url }}')" class="file-input items-center">

    <!-- Preview Image -->
    <div class=" bg-gray-100 w-fit mx-auto">
      <!-- Placeholder image -->
      <div x-show="!previewPhoto" >

      </div>
      <!-- Show a preview of the photo -->
      <div x-show="previewPhoto" class=" overflow-hidden bg-gris-90">
        <img :src="previewPhoto" width="75%" height="75%"
             alt=""
             class=" object-cover mx-auto">
      </div>
    </div>

    <div class="items-center ">
      <!-- File Input -->
      <div class="rounded-md shadow-sm my-4 flex">
        <!-- Replace the file input styles with our own via the label -->
        <input @change="updatePreview($refs)" x-ref="input"
               type="file" @if($livewire)  wire:model='logo' @endif
               accept="image/*,capture=camera"
               name="photo" id="photo"
               class="custom">
        <label for="photo"
               class="mx-auto py-2 px-3 border border-gris-40 rounded-md text-sm leading-4 font-medium text-gris-20 hover:text-gris-10 hover:border-gris-10 focus:outline-none focus:border-gris-5 focus:shadow-outline-indigo active:bg-gris-30 active:text-gris-80 transition duration-150 ease-in-out cursor-pointer select-none">
          subir foto
        </label>
      </div>

      <div class="items-center text-sm text-gray-500 mx-auto" @notify.window="previewPhoto=$event.detail.url; fileName=$event.detail.filename;" @notify2.window="clearPreview($refs)">
        <!-- Display the file name when available -->
        <div class=" w-fit mx-auto flex items-center">
        <span x-text="fileName || emptyText" class="text-[12px] text-gris-40 text-center"></span>
        <!-- Removes the selected file -->
        <button x-show="fileName"
                @click="clearPreview($refs); @if($livewire) $wire.deletelogo(); @endif "
                type="button"
                aria-label="Remove image"
                class="mx-3 mt-1">
          <svg viewBox="0 0 20 20" fill="currentColor" class="x-circle w-7 h-7"
               aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
        </button>
           </div>
      </div>

    </div>

  </div>

@push('styles')
<style>
    input[type="file"].custom {
        border: 0;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        overflow: hidden;
        padding: 0;
        position: absolute !important;
        white-space: nowrap;
        width: 1px;
      }
</style> 
@endpush
@push('scripts')
<script>
    function imageData(url) {
        const originalUrl = url || '';
        return {
          previewPhoto: originalUrl,
          fileName: null,
          emptyText: originalUrl ? 'No se ha elegido ningún archivo nuevo' : 'Ningún archivo elegido',
          updatePreview($refs) {
            var reader,
                files = $refs.input.files;
            reader = new FileReader();
            reader.onload = (e) => {
              this.previewPhoto = e.target.result;
              this.fileName = files[0].name;
            };
            reader.readAsDataURL(files[0]);
          },
          clearPreview($refs) {
            $refs.input.value = null;
            this.previewPhoto = originalUrl;
            this.fileName = false;
          }
        };
      }
</script>
@endpush
