@extends('frontend.layout.main')
@section('container')
    {{-- ======================================
                    DOCUMENT TRACKER
    ======================================= --}}
    <div id="document-tracker">
        <div class="container-fluid">
            <div class="tracker-container">
                <div class="row">

                    <div class="col-12">
                        <div class="inner-block doc-info-block">
                            <div class="top-block">
                                <div class="title">
                                    Lorem ipsum dolor sit.
                                </div>
                                <div class="buttons">
                                    <button>Edit</button>
                                    <button>Cancel</button>
                                    <button>Print</button>
                                </div>
                            </div>
                            <div class="bottom-block">
                                <div>
                                    <div class="head">Document Number</div>
                                    <div>DFHJKERDFGFG5678</div>
                                </div>
                                <div>
                                    <div class="head">Department</div>
                                    <div>QA</div>
                                </div>
                                <div>
                                    <div class="head">Document Type</div>
                                    <div>FORM</div>
                                </div>
                                <div>
                                    <div class="head">Working Status</div>
                                    <div>Working</div>
                                </div>
                                <div>
                                    <div class="head">Last Modified By</div>
                                    <div>Piyush Sahu</div>
                                </div>
                                <div>
                                    <div class="head">Last Modified On</div>
                                    <div>23 January, 2023</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="inner-block tracker">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="main-title">
                                    Record Workflow
                                </div>
                                <button>
                                    Submit for Review&nbsp;<i class="fa-regular fa-paper-plane"></i>
                                </button>
                                {{-- <button>
                                    Submit for Approval&nbsp;<i class="fa-regular fa-paper-plane"></i>
                                </button> --}}
                            </div>
                            <div class="status">
                                <div class="head">Current Status</div>
                                <div class="progress-bars">
                                    <div class="active">Draft</div>
                                    <div class="active">Under Review</div>
                                    <div>Reviewed</div>
                                    <div>Under Approval</div>
                                    <div>Approved</div>
                                    <div>Effective</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div>
                            <div class="inner-block person-table">
                                <div class="main-title mb-0">
                                    Reviewers
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#doc-reviewers">
                                    Edit&nbsp;<i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </div>
                            <div class="inner-block person-table">
                                <div class="main-title mb-0">
                                    Approvers
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#doc-approvers">
                                    Edit&nbsp;<i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="inner-block doc-overview">
                            <div class="main-title">Preview</div>
                            <div class="doc"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="doc-reviewers">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reviewers</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="add-reviewer">
                        <select id="choices-multiple-remove-button" name="reviewers" placeholder="Select Reviewers"
                            multiple>
                            <option value="HTML">HTML</option>
                            <option value="Jquery">Jquery</option>
                            <option value="CSS">CSS</option>
                            <option value="Bootstrap 3">Bootstrap 3</option>
                            <option value="Bootstrap 4">Bootstrap 4</option>
                            <option value="Java">Java</option>
                            <option value="Javascript">Javascript</option>
                            <option value="Angular">Angular</option>
                            <option value="Python">Python</option>
                            <option value="Hybris">Hybris</option>
                            <option value="SQL">SQL</option>
                            <option value="NOSQL">NOSQL</option>
                            <option value="NodeJS">NodeJS</option>
                        </select>
                    </div>
                    <div class="reviewer-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Reviewers</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Piyush Sahu</td>
                                    <td>Quality Analysis</td>
                                    <td>Review Pending</td>
                                    <td class="text-center">
                                        <button><i class="fa-regular fa-trash-can"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button>Update</button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="doc-approvers">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Approvers</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="add-reviewer">
                        <select id="choices-multiple-remove-button" name="reviewers" placeholder="Select Approvers"
                            multiple>
                            <option value="HTML">HTML</option>
                            <option value="Jquery">Jquery</option>
                            <option value="CSS">CSS</option>
                            <option value="Bootstrap 3">Bootstrap 3</option>
                            <option value="Bootstrap 4">Bootstrap 4</option>
                            <option value="Java">Java</option>
                            <option value="Javascript">Javascript</option>
                            <option value="Angular">Angular</option>
                            <option value="Python">Python</option>
                            <option value="Hybris">Hybris</option>
                            <option value="SQL">SQL</option>
                            <option value="NOSQL">NOSQL</option>
                            <option value="NodeJS">NodeJS</option>
                        </select>
                    </div>
                    <div class="reviewer-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Approvers</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Piyush Sahu</td>
                                    <td>Quality Analysis</td>
                                    <td>Review Pending</td>
                                    <td class="text-center">
                                        <button><i class="fa-regular fa-trash-can"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button>Update</button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
