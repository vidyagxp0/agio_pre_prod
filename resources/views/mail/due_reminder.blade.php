<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Due Date Reminder</title>
</head>

<body style="margin:0;padding:30px;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #ddd;">

                    <!-- Header -->
                    <tr>
                        <td align="center"
                            style="background:#5865d8;padding:20px;color:#fff;font-size:24px;font-weight:bold;">
                            ⚠️ Due Date Reminder
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px;">

                            <p style="font-size:15px;color:#333;">
                                Dear <strong>{{ $user->name }}</strong>,
                            </p>

                            <p style="font-size:15px;color:#444;line-height:24px;">
                                This is a reminder that the following
                                <strong>{{ $processName }}</strong> record is approaching
                                its due date.
                                Please complete all pending activities before the due date.
                            </p>

                            <!-- Info Table -->
                            <table width="100%" cellpadding="10" cellspacing="0"
                                style="border-collapse:collapse;margin-top:20px;">

                                <tr style="background:#f8f8f8;">
                                    <td width="35%"
                                        style="border:1px solid #ddd;font-weight:bold;">
                                        Process
                                    </td>

                                    <td style="border:1px solid #ddd;">
                                        {{ $processName }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #ddd;font-weight:bold;">
                                        Record Number
                                    </td>

                                    <td style="border:1px solid #ddd;">
                                        {{ $recordNumber }}
                                    </td>
                                </tr>

                                <tr style="background:#f8f8f8;">
                                    <td style="border:1px solid #ddd;font-weight:bold;">
                                        Due Date
                                    </td>

                                    <td style="border:1px solid #ddd;color:#d32f2f;font-weight:bold;">
                                        {{ \Carbon\Carbon::parse($dueDate)->format('d M Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #ddd;font-weight:bold;">
                                        Days Remaining
                                    </td>

                                    <td style="border:1px solid #ddd;">

                                        @if($remainingDays>0)

                                            <span style="color:#ff9800;font-weight:bold;">
                                                {{ $remainingDays }} Day(s)
                                            </span>

                                        @elseif($remainingDays==0)

                                            <span style="color:#d32f2f;font-weight:bold;">
                                                Due Today
                                            </span>

                                        @else

                                            <span style="color:#d32f2f;font-weight:bold;">
                                                Overdue by {{ abs($remainingDays) }} Day(s)
                                            </span>

                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #ddd;font-weight:bold;">
                                        Short Description
                                    </td>

                                    <td style="border:1px solid #ddd;">
                                        {{ $record->short_description ?? 'N/A' }}
                                    </td>
                                </tr>

                            </table>

                            <!-- Warning -->
                            <table width="100%" style="margin-top:25px;">
                                <tr>
                                    <td style="background:#fff8e1;border-left:5px solid #ff9800;padding:15px;color:#555;">

                                        <strong>Reminder:</strong>

                                        Kindly ensure this activity is completed before
                                        the due date to avoid delays in the workflow.

                                    </td>
                                </tr>
                            </table>

                            <!-- Button -->
                            <div style="text-align:center;margin-top:35px;">

                                <a href="{{ $recordUrl }}"
                                    style="
                                    background:#28a745;
                                    color:#ffffff;
                                    text-decoration:none;
                                    padding:14px 35px;
                                    border-radius:5px;
                                    font-size:16px;
                                    font-weight:bold;
                                    display:inline-block;">

                                    🔗 View {{ $processName }} Record

                                </a>

                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background:#f3f3f3;padding:18px;text-align:center;color:#888;font-size:12px;">

                            This notification has been automatically generated by the <strong>VidyaGxP QMS</strong>.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>