@if ($data->HolTimSutRepfile_attach)
    @foreach (json_decode($data->HolTimSutRepfile_attach) as $file)
        <iframe src="{{ asset('upload/' . $file) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" style="border: none;"></iframe>
    @endforeach
@endif