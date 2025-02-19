@if ($data->ProValProtocol)
    @foreach (json_decode($data->ProValProtocol) as $file)
        <iframe src="{{ asset('upload/' . $file) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" style="border: none;"></iframe>
    @endforeach
@endif