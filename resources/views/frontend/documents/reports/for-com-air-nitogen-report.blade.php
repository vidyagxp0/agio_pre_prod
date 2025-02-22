@if ($data->attach_comp_nitrogen)
    @foreach (json_decode($data->attach_comp_nitrogen) as $file)
        <iframe src="{{ secure_asset('upload/' . $file) }}#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="600px" style="border: none;"></iframe>
    @endforeach
@endif