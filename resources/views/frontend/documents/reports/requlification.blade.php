@if ($data->document_content->aqpattachement)
    @foreach (json_decode($data->document_content->aqpattachement) as $file)
        <iframe src="{{ secure_asset('upload/' . $file) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" style="border: none;"></iframe>
    @endforeach
@endif