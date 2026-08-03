<a
    href="{{ route(
        'rcms.logs.print',
        ['slug' => request()->route('slug')]
    ) }}"
    target="_blank"
    class="btn btn-primary"
>
    <i class="fa fa-print"></i>
    Print
</a>