<h3>Attachments Preview</h3>

{{-- @foreach ($data as $file)
    <iframe src="{{ asset('upload/' . $file) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" style="border: none;"></iframe>
@endforeach --}}

@if ($data->document_content->pvpattachement)
    @foreach (json_decode($data->document_content->pvpattachement) as $file)
        <iframe src="{{ asset('upload/' . $file) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" style="border: none;"></iframe>
    @endforeach
@endif


