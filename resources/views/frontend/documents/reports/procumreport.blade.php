@if ($data->procumrepo_file_attach)
    @foreach (json_decode($data->procumrepo_file_attach) as $file)
        <iframe src="{{ secure_asset('upload/' . $file) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" style="border: none;"></iframe>
    @endforeach
@endif