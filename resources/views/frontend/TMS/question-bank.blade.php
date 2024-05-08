@extends('frontend.layout.main')
@section('container')
    @include('frontend.TMS.head')



    {{-- ======================================
                    QUESTION BANK
    ======================================= --}}
    <div id="tms-question-bank">
        <div class="container-fluid">

            <div class="search-bar">
                <form action="#">
                    <input type="text" name="search" placeholder="Search Questions Banks...">
                    <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
                </form>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="inner-block question-table">
                        <div class="head-bar">
                            <div class="head">
                                Questions Banks Lists
                            </div>
                            <div class="d-flex align-items-center" style="gap:20px;">
                                <div class="add-question-bank" data-bs-toggle="modal" data-bs-target="#question-bank-modal">
                                    <i class="fa-solid fa-plus"></i>&nbsp;Add Question Bank
                                </div>
                                {{-- <button>Print</button> --}}
                            </div>
                        </div>
                        <div class="table-block">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Sr. No.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="searchTable">
                                    @if(!empty($data))
                                    @foreach ($data as $key => $temp)
                                        <tr class="single-select">
                                            <td>{{ $key+1 }}.</td>
                                            <td>
                                                {{ $temp->title }}
                                            </td>
                                            <td class="question">
                                                {{ $temp->description }}
                                            </td>
                                            <td>{{ $temp->status }}</td>
                                            <td>
                                                <div class="action-btns">
                                                    <form action="{{ route('question-bank.destroy', $temp->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    <a href="{{ route('question-bank.edit', $temp->id) }}">Manage</a>
                                                </div>
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
        </div>
    </div>


    {{-- ======================================
            ADD QUESTION  BANK MODAL
    ======================================= --}}
    <div class="modal fade" id="question-bank-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Question Bank</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('question-bank.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="title">Title</label>
                            <input type="text" name="title" required>
                        </div>
                        <div class="group-input">
                            <label for="status">Status</label>
                            <select name="status">
                                <option value="Active" selected>Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="desc">Description</label>
                            <textarea name="description"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    {{-- ======================================
                    ADD QUIZ MODAL
    ======================================= --}}
    <div class="modal fade modal-lg" id="quiz-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Quiz</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="quiz-name">
                        <label for="quiz">Quiz Name</label>
                        <input type="text" name="quiz-name">
                    </div>
                    <div class="question-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Question</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="question"></td>
                                    <td>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non dignissimos fuga
                                        accusamus!
                                    </td>
                                    <td>Single Selection Question</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="question"></td>
                                    <td>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non dignissimos fuga
                                        accusamus!
                                    </td>
                                    <td>Exact Answer Question</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="question"></td>
                                    <td>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non dignissimos fuga
                                        accusamus!
                                    </td>
                                    <td>Multiple Selection Question</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Cancel</button>
                    <button type="button">Save</button>
                </div>

            </div>
        </div>
    </div>


    <script>
        // ================================ Show and Hide Rows
        function toggleRows() {
            const checkboxes = document.querySelectorAll('.question-filter');
            checkboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', () => {
                    const target = checkbox.dataset.target;
                    const rows = document.querySelectorAll(`.${target}`);
                    rows.forEach((row) => {
                        row.style.display = checkbox.checked ? '' : 'none';
                    });
                });
            });
        }

        toggleRows();


        // ============================= Deleting Rows
        const deleteButtons = document.querySelectorAll('.fa-trash-can');
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const row = button.parentNode.parentNode.parentNode.parentNode;
                row.parentNode.removeChild(row);
            });
        });

        // ============================= Add Options Inputs
        function addOption() {
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'options';
            var container = document.querySelector('.question-options');
            container.appendChild(newInput);
        }

        // ============================= Add Answer Inputs
        function addAnswer() {
            var newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'options';
            var container = document.querySelector('.question-answer');
            container.appendChild(newInput);
        }

        // =========================== Toggle Input Fields Using Select Options
        function handleChange(value) {
            var answerGroup = document.querySelector('.question-answer');
            var optionsGroup = document.querySelector('.question-options');
            var answerButton = document.querySelector('#answer-label button');
            var optionsButton = document.querySelector('.question-options button');
            if (value === 'multi-select') {
                answerGroup.style.display = 'block';
                answerButton.style.display = 'inline-block';
                optionsGroup.style.display = 'block';
                optionsButton.style.display = 'inline-block';
            } else if (value === 'single-word') {
                answerGroup.style.display = 'block';
                answerButton.style.display = 'none';
                optionsGroup.style.display = 'none';
                optionsButton.style.display = 'none';
            } else if (value === 'single-select') {
                answerGroup.style.display = 'block';
                answerButton.style.display = 'none';
                optionsGroup.style.display = 'block';
                optionsButton.style.display = 'inline-block';
            }
        }
    </script>
@endsection
