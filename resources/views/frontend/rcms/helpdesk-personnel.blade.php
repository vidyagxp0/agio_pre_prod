@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    {{-- ======================================
                HELPDESK PERSONNEL
    ======================================= --}}
    <div id="helpdesk-personnel">
        <div class="container-fluid">

            <div class="inner-block">
                <div class="main-head">
                    HelpDesk Personnel
                </div>
                <div class="inner-block-content">
                    <div class="help-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>HD</th>
                                    <th>Person</th>
                                    <th>Division</th>
                                    <th>Phone</th>
                                    <th>E-Mail</th>
                                    <th>Pin</th>
                                    <th>City</th>
                                    <th>State</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01.</td>
                                    <td>Yes</td>
                                    <td>Vikas Prajapati</td>
                                    <td>Tech Support</td>
                                    <td>6264992922</td>
                                    <td>vikas.prajapati@connexo.io</td>
                                    <td>470001</td>
                                    <td>Sagar</td>
                                    <td>Madhya Pradesh</td>
                                </tr>
                                <tr>
                                    <td>02.</td>
                                    <td>Yes</td>
                                    <td>Gopal Sen</td>
                                    <td>Tech Support</td>
                                    <td>8009109401</td>
                                    <td>gopal.sen@connexo.io</td>
                                    <td>470001</td>
                                    <td>Sagar</td>
                                    <td>Madhya Pradesh</td>
                                </tr>
                                <tr>
                                    <td>03.</td>
                                    <td>Yes</td>
                                    <td>Amit Patel</td>
                                    <td>Tech Support</td>
                                    <td>7354654474</td>
                                    <td>amit.patel@connexo.io</td>
                                    <td>470001</td>
                                    <td>Sagar</td>
                                    <td>Madhya Pradesh</td>
                                </tr>
                                <tr>
                                    <td>04.</td>
                                    <td>Yes</td>
                                    <td>Anshul Patel</td>
                                    <td>Tech Support</td>
                                    <td>8305375136</td>
                                    <td>anshul.patel@connexo.io</td>
                                    <td>470001</td>
                                    <td>Sagar</td>
                                    <td>Madhya Pradesh</td>
                                </tr>
                                <tr>
                                    <td>05.</td>
                                    <td>Yes</td>
                                    <td>Anshul Jain</td>
                                    <td>Tech Support</td>
                                    <td>8303993561</td>
                                    <td>anshul.jain@connexo.io</td>
                                    <td>470001</td>
                                    <td>Sagar</td>
                                    <td>Madhya Pradesh</td>
                                </tr>
                                <tr>
                                    <td>06.</td>
                                    <td>Yes</td>
                                    <td>Rohit Thakur</td>
                                    <td>Tech Support</td>
                                    <td>7447011439</td>
                                    <td>rohit.thakur@connexo.io</td>
                                    <td>470001</td>
                                    <td>Sagar</td>
                                    <td>Madhya Pradesh</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="note">
                        HD indicates HelpDesk specific personnel. Others are Connexo Administrators, which should be
                        contacted only when no HelpDesk Specific persons are available.
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
