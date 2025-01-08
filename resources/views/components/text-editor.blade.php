<div>
    <div id="{{ $id }}" class="quill-editor h-[{{ $height }}] w-full  block mb-1 text-sm font-medium text-gray-900 " ></div>
<textarea name="{{ $name }}" id="{{ $id }}-hidden" style="display: none;"></textarea>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quill = new Quill('#{{ $id }}', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'], // Text formatting
                    ['link', 'image'], // Media options
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }], // Lists
                    [{ 'header': [1, 2, 3, false] }], // Headings
                ]
            }
        });

        var hiddenInput = document.getElementById('{{ $id }}-hidden');

        quill.on('text-change', function () {
            hiddenInput.value = quill.root.innerHTML;
        });

        @if($content)
        quill.root.innerHTML = `{!! $content !!}`;
        @endif
    });
</script>
@endpush
