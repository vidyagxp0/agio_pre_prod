@extends('frontend.layout.main')
@section('container')
    <section id="manual-notification">
        <div class="container-fluid">
            <div class="inner-block">
                <div class="main-head">
                    Record {{ $document->id }} - {{ $document->document_name }}
                </div>
                <div class="inner-block-content">
                    <div class="details">
                        <div>
                            <strong>Division/Project : </strong>
                            {{ $document->division->name }} / {{ $document->process ? $document->process->process_name : '' }}
                        </div>
                        <div>
                            <strong>Record State : </strong>
                            {{ $document->status }}
                        </div>
                        <div>
                            <strong>Assigned To : </strong>
                            {{ $document->oreginator ? $document->oreginator->name : '' }}
                        </div>
                        <div>
                            <strong>Recipents - Add : </strong>
                            <form action="{{ url('send-notification') }}" method="POST">
                                @csrf
                                <div class="search-input">
                                    <select name="option" id="my-select">
                                        <option value="0">-- Select Recipent</option>

                                        @php
                                            $rev_data = explode(',', $document->reviewers);
                                            $i = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($rev_data); $i++)
                                            @php
                                                $user = DB::table('users')
                                                    ->where('id', $rev_data[$i])
                                                    ->first();

                                            @endphp
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endfor
                                        @php
                                            $rev_data = explode(',', $document->approvers);
                                            $i = 0;
                                        @endphp
                                        @for ($i = 0; $i < count($rev_data); $i++)
                                            @php
                                                $user = DB::table('users')
                                                    ->where('id', $rev_data[$i])
                                                    ->first();
                                            @endphp
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endfor



                                    </select>
                                 
                                    {{-- <label for="recipent">Add</label> --}}
                                </div>
                        </div>
                    </div>
                    <div class="recipent-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Recipent</th>
                                    <th>Relationship</th>
                                    <th>Method</th>

                                </tr>
                            </thead>
                            <tbody id="my-table-body">

                            </tbody>
                        </table>
                    </div>
                    <div class="summary">
                        <div class="group-input">
                            <label for="summary">Notification Summary</label>
                            <textarea name="summary"></textarea>
                        </div>
                        <div class="group-input">
                            <label for="summary">Attach file</label>
                            <input type="file" name="file">
                        </div>
                    </div>
                    <div class="noti-btns">
                        <button type="submit">Send to</button>
                        <button>Cancel</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#my-select').change(function() {
                var selectedOption = $(this).val();

                // Send an AJAX request to fetch the data for the selected option
                $.ajax({
                    url: '/get-data',
                    type: 'GET',
                    data: {
                        option: selectedOption
                    },

                    success: function(response) {

                        // Update the table with the selected data
                        $('#my-table-body').html(`
                            <tr>
                                <th>${response.name}<input type="hidden" value="${response.name}"></th>
                                <th>${response.role}<input type="hidden" value="${response.role}"></th>
                                <th>
                                        <select name="method">
                                            <option>-- Select --</option>
                                            <option value="email">E-Mail</option>
                                        </select>
                                    </th>
                            </tr>
                        `);
                    },
                    error: function(xhr, status, error) {

                        // Handle the error if the AJAX request fails
                    }
                });
            });
        });
    </script>
@endsection
