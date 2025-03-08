@if ($data->document_content->APQPattachement)
    @foreach (json_decode($data->document_content->APQPattachement) as $file)
        <iframe src="{{ secure_asset('upload/' . $file) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" style="border: none;"></iframe>
    @endforeach
@endif