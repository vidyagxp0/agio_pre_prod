<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Reviewed Notification</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f9; font-family:Arial, Helvetica, sans-serif; color:#333333;">

    @php
        $division = DB::table('divisions')->find($document->division_id);
        $doctype = DB::table('document_types')->find($document->document_type_id);
        $originator = DB::table('users')->find($document->originator_id);

        $year = \Carbon\Carbon::parse($document->created_at)->format('Y');
        $num = str_pad($document->id, 5, '0', STR_PAD_LEFT);

        $documentNumber = $document->document_number ?? 'N/A';

        $documentStatus = $document->status ?? 'N/A';
    @endphp

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
           border="0" style="background-color:#f4f6f9; padding:25px 10px;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellspacing="0" cellpadding="0"
                       border="0"
                       style="width:100%; max-width:600px; background-color:#ffffff; border:1px solid #e2e6ea;">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1558af; padding:18px 25px;">
                            <img src="{{ asset('user/images/logo.png') }}"
                                 alt="Company Logo"
                                 style="display:block; width:120px; max-width:100%; height:auto; border:0;">
                        </td>
                    </tr>

                    <!-- Title -->
                    <tr>
                        <td style="padding:25px 25px 10px;">
                            <h2 style="margin:0; font-size:21px; line-height:1.4; color:#1558af; font-weight:600;">
                                Document Reviewed Notification
                            </h2>
                        </td>
                    </tr>

                    <!-- Message -->
                    <tr>
                        <td style="padding:10px 25px 20px; font-size:14px; line-height:1.7; color:#444444;">
                            <p style="margin:0 0 12px;">Hello Admin,</p>

                            <p style="margin:0;">
                                The following document has been reviewed by the reviewer.
                                Please log in to the Document Management System to view
                                the document details and check its current status.
                            </p>
                        </td>
                    </tr>

                    <!-- Document Details -->
                    <tr>
                        <td style="padding:0 25px 20px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                                   border="0"
                                   style="border-collapse:collapse; font-size:14px;">

                                <tr>
                                    <td colspan="2"
                                        style="padding:12px; background-color:#eef4fc; border:1px solid #d9e2ef; color:#1558af; font-weight:bold;">
                                        Document Details
                                    </td>
                                </tr>

                                <tr>
                                    <td width="38%"
                                        style="padding:11px; border:1px solid #e2e6ea; font-weight:bold; background-color:#f8f9fb;">
                                        Document Name
                                    </td>
                                    <td style="padding:11px; border:1px solid #e2e6ea; overflow-wrap:anywhere;">
                                        {{ $document->document_name ?? 'N/A' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:11px; border:1px solid #e2e6ea; font-weight:bold; background-color:#f8f9fb;">
                                        Document Number
                                    </td>
                                    <td style="padding:11px; border:1px solid #e2e6ea; overflow-wrap:anywhere;">
                                        {{ $documentNumber }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:11px; border:1px solid #e2e6ea; font-weight:bold; background-color:#f8f9fb;">
                                        Author
                                    </td>
                                    <td style="padding:11px; border:1px solid #e2e6ea;">
                                        {{ $originator->name ?? 'N/A' }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:11px; border:1px solid #e2e6ea; font-weight:bold; background-color:#f8f9fb;">
                                        Document Status
                                    </td>
                                    <td style="padding:11px; border:1px solid #e2e6ea;">
                                        <span style="display:inline-block; padding:5px 10px; background-color:#e8f1ff; color:#1558af; font-weight:bold; border-radius:3px;">
                                            {{ $documentStatus }}
                                        </span>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- Action Button -->
                    <tr>
                        <td align="center" style="padding:5px 25px 25px;">
                            <p style="margin:0 0 18px; font-size:14px; line-height:1.6; color:#444444;">
                                Click below to view the document details in the DMS.
                            </p>

                            <a href="{{ url('doc-details', $document->id) }}"
                               style="display:inline-block; padding:12px 24px; background-color:#1558af; color:#ffffff; text-decoration:none; font-size:14px; font-weight:bold; border-radius:4px;">
                                View Document
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:16px 25px; background-color:#f8f9fb; border-top:1px solid #e2e6ea; text-align:center;">
                            <p style="margin:0 0 6px; font-size:12px; line-height:1.5; color:#555555;">
                                You can see all your assigned tasks on your DMS Dashboard.
                            </p>
                            <p style="margin:0; font-size:11px; color:#888888;">
                                This is an automated notification from the Document Management System.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>