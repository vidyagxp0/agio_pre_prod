<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Due Date Reminder</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:20px;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#6c7ae0; padding:20px; text-align:center;">
                            <img src="https://vidyagxp.com/vidyaGxp_logo.png" width="120" alt="Logo">
                            <h2 style="color:#ffffff; margin:10px 0 0;">Due Date Reminder</h2>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:20px; color:#333;">

                            <p>Dear User,</p>

                            <p>
                                This is a reminder that the following process is approaching its due date.
                                Please take necessary action before the deadline.
                            </p>

                            <!-- Table -->
                            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse; margin-top:15px;">
                                <tr style="background:#eaeefc;">
                                    <th style="border:1px solid #ddd;">Process</th>
                                    <th style="border:1px solid #ddd;">Due Date</th>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #ddd; text-align:center;">
                                        {{ class_basename($processName) }}
                                    </td>

                                    <td style="border:1px solid #ddd; text-align:center;">
                                        {{ \Carbon\Carbon::parse($record->due_date)->format('d M Y') }}
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-top:20px; color:#d9534f;">
                                ⚠️ Please complete this task before the due date.
                            </p>

                            <p>
                                If already completed, please ignore this email.
                            </p>

                            <p style="margin-top:20px;">
                                Regards,<br>
                                <strong>VidyaGxP System</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f1f1f1; padding:10px; text-align:center; font-size:12px; color:#777;">
                            This is an automated email. Please do not reply.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>