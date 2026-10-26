@if ($data->compressed_air_sys_protocol)
    @foreach (json_decode($data->compressed_air_sys_protocol) as $file)
        <iframe src="{{ secure_asset('upload/' . $file) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" style="border: none;"></iframe>
    @endforeach
@endif