@extends('frontend.layout.main')
@section('container')
    @include('frontend.TMS.head')




    {{-- ======================================
                MANAGE QUESTION BANK
    ======================================= --}}
    <div id="manage-quizzes">
        <div class="container-fluid">

            <div class="create-block">
                <a href="{{ route('quize.create') }}">
                    <i class="fa-solid fa-plus"></i>&nbsp;Create Quiz
                </a>
            </div>

            <div class="inner-block quiz-table">
                <div class="main-head">
                    <div>Quiz</div>
                    {{-- <div>
                        <button>Print</button>
                    </div> --}}
                </div>
                <div class="inner-block-content">
                    <table class="table-bordered table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Active Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data))
                            @foreach ($data as $temp)
                                <tr>
                                    <td>{{ $temp->title }}</td>
                                    <td>{{ $temp->description }}</td>
                                    <td>{{ $temp->category }}</td>
                                    <td>{{ $temp->status }}</td>
                                    <td>
                                        <form action="{{ route('quize.destroy', $temp->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                        <a href="{{ route('quize.edit',$temp->id) }}">Edit</a>

                                    </td>
                                </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
