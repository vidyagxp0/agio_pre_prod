@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    TMS HEAD
    ======================================= --}}
    @include('frontend.TMS.head')

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        @php
        toastr()->error($error);
        @endphp
        @endforeach
    @endif


    {{-- ======================================
                    CREATE QUIZ
    ======================================= --}}
    <div id="create-quiz">
        <div class="container-fluid">

            <form action="{{ route('quize.store') }}" method="post">
                @csrf
            <div class="inner-block quiz-table">
                <div class="main-head">
                    Manage Quiz
                </div>
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="title">Title</label>
                                <input type="text" id="quize-title" name="title" >
                            </div>
                            <p id="quizecheck"
                            style="color: red;">
                            **Quize Title is missing
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="desc">Description</label>
                                <textarea name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="category">Category</label>
                                <input type="text" name="category">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="pass-percent">Passing Percentage</label>
                                <input type="number" id="passing-percentage" name="passing">
                            </div>
                            <p id="passingcheck"
                            style="color: red;">
                            **Passing Percentage of quize is missing
                            </p>
                        </div>
                        {{-- <div class="col-lg-6">
                            <div class="checkbox">
                                <label for="randomize">
                                    <input type="checkbox" name="randomize" id="randomize">
                                    Randomize Questions
                                </label>
                            </div>
                        </div> --}}
                        <!-- <div class="col-lg-6">
                            <div class="checkbox">
                                <label for="feedback">
                                    <input type="checkbox" name="feedback" id="feedback">
                                    Show Feedback
                                </label>
                            </div>
                        </div> -->
                        <div class="col-12">
                            <div class="group-input">
                                <label for="question-bank">Choose Question Bank</label>
                                <select name="question_bank" id="question-bank">
                                    <option value="">---</option>
                                    @foreach ($questions as $data)
                                    <option data-id="{{ $data->id }}" value="{{ $data->id }}">{{ $data->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p id="question-bank-check"
                            style="color: red;">
                            **Select Question bank first.
                            </p>
                        </div>
                       
                        <div class="col-12">
                            <div class="question-container">
                                <div class="left-block">
                                    <div class="head">Select Questions</div>
                                    <table class="table table-bordered left-table">
                                        <thead>
                                            <tr>
                                                <th>Question</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody id="question-list">


                                        </tbody>
                                    </table>
                                </div>
                                <div class="right-block">
                                    <div class="head">Selected Questions</div>
                                    <table class="table table-bordered right-table">
                                        <thead>
                                            <tr>
                                                <th>Question</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="selected-question">
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="foot-btns">
                <button>Cancel</button>
                <button id="quize-Submit" type="submit">Save</button>
            </div>
            </form>

        </div>
    </div>


    <script>
        const itemList = document.getElementById('question-list');
        const selectedList = document.getElementById('selected-question');
        itemList.addEventListener('click', function(e) {
            const selectedItem = e.target.closest('tr');
            if (selectedItem) {
                const itemData = selectedItem.getAttribute('data-item');
                const existingItem = selectedList.querySelector(`tr[data-item="${itemData}"]`);
                if (!existingItem) {
                    const newItem = selectedItem.cloneNode(true);
                    const deleteBtn = document.createElement('button');
                    deleteBtn.textContent = 'Delete';
                    deleteBtn.addEventListener('click', function() {
                        newItem.remove();
                    });
                    const td = document.createElement('td');
                    const inputType = document.createElement('input');
                    inputType.setAttribute("type", "hidden");
                    inputType.setAttribute("name", "questions[]");
                    inputType.setAttribute("value", itemData);
                    inputType.setAttribute("id", "questionsSelect");
                    td.appendChild(deleteBtn);
                    newItem.appendChild(td);
                    newItem.appendChild(inputType);
                    selectedList.appendChild(newItem);
                }
            }
        });
    </script>
@endsection
