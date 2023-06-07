<x-otros.modal wire:model="show_image" maxWidth="sm">
    <x-slot name="title">
        Acicionar Imagen
    </x-slot>
    <form action="{{ route('order.product.images', $selected_id) }}"
        class="dropzone"
        id="my-awesome-dropzone">
    </form>
    </x-otros.modal>
@push('styles')
    {{-- Dropzone css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css">
@endpush
@push('scripts')
  {{-- Dropzon js --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

  <script>
    var myDropzone = new Dropzone('.dropzone', {
            paramName: 'image',
            acceptedFiles: 'image/*',
            maxFilesize: 2,
            maxFiles: 1,
            createImageThumbnails: true,
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        });

        myDropzone.on('error', function(file, res){
            var msg = res.errors.photo[0];
            $('.dz-error-message:last > span').text(msg);
        });

        Dropzone.autoDiscover = false;
  </script>
  @endpush