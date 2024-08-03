<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Annexure Report</title>
    <style>
        * {
            font-family: "Open Sans", sans-serif;
        }

        html {
            text-align: justify;
            text-justify: inter-word;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        .header-table img {
            width: 100px;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }

        .header-table {
            height: 150px;
        }

        .title {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .doc-num {
            font-size: 1rem;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #ddd;
        }

        .main-section {
            text-align: left;
            margin-top: 200px;
        }

        .annexure-content {
            margin: 0 2.5rem;
            width: 650px;
        }
    </style>
</head>

<body>
    <header>
        <table class="header-table">
            <tr>
                <td class="logo">
                    <img src="{{ asset('user/images/agio.jpg') }}" alt="Logo">
                </td>
                <td class="title">
                    <p>{{ config('site.pdf_title') }}</p>
                    <p>{{ $data->document_name }}</p>
                </td>
                <td class="logo">
                    <img src="{{ asset('user/images/agio.jpg') }}" alt="Logo">
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="doc-num">
                    @php
                    $temp = DB::table('document_types')->where('name', $data->document_type_name)->value('typecode');
                    @endphp
                    @if($data->revised === 'Yes')
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{ $temp }} /@endif{{ $data->year }}
                        /000{{ $data->document_number }}/R{{$data->major}}.{{$data->minor}}
                    @else
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{ $temp }} /@endif{{ $data->year }}
                        /000{{ $data->document_number }}/R{{$data->major}}.{{$data->minor}}
                        A-{{ $annexure_number }}
                    @endif
                </td>
            </tr>
        </table>
    </header>

    <footer class="footer">
        <table>
            <tr>
                <td class="text-left">
                    @php
                    $temp = DB::table('document_types')->where('name', $data->document_type_name)->value('typecode');
                    @endphp
                    @if($data->revised === 'Yes')
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{ $temp }} /@endif{{ $data->year }}
                        /000{{ $data->document_number }}/R{{$data->major}}.{{$data->minor}}
                    @else
                        {{ Helpers::getDivisionName($data->division_id) }}
                        /@if($data->document_type_name){{ $temp }} /@endif{{ $data->year }}
                        /000{{ $data->document_number }}/R{{$data->major}}.{{$data->minor}}
                    @endif
                    A-{{ $annexure_number }}
                </td>
                <td>Printed On: {{ $time }}</td>
            </tr>
        </table>
    </footer>

    <section class="main-section">
        <div class="annexure-content">
            {!! nl2br($annexure_data) !!}
        </div>
    </section>
</body>
</html>
