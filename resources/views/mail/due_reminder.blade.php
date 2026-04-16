<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Due Date Reminder - {{ $processName ?? 'Process' }}</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:20px;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

                    <tr style="background:#6c7ae0;">
                        <td style="padding:20px; text-align:center;">
                            <h2 style="color:#ffffff; margin:0;">Due Date Reminder</h2>
                        </td>
                    </tr>

                     <tr>
                        <td style="padding:20px; color:#333;">
                            
                            <p>Dear <strong>{{ $user->name ?? 'User' }}</strong>,</p>
                            
                            <p>This is a reminder that the following process is approaching its due date.</p>
                            
                            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">
                                <tr style="background:#f0f0f0;">
                                    <th style="border:1px solid #ddd; text-align:left; padding:8px;">Process</th>
                                    <td style="border:1px solid #ddd; padding:8px;">{{ $processName ?? 'Process' }}</td>
                                </tr>
                                <tr>
                                    <th style="border:1px solid #ddd; text-align:left; padding:8px;">Record Number</th>
                                    <td style="border:1px solid #ddd; padding:8px;">
                                       <strong>
                                            {{ !empty($recordNumber) ? $recordNumber : 'N/A' }}
                                        </strong>
                                    </td>
                                </tr>
                                <tr style="background:#f0f0f0;">
                                    <th style="border:1px solid #ddd; text-align:left; padding:8px;">Due Date</th>
                                    <td style="border:1px solid #ddd; padding:8px; color:#d9534f;">
                                        {{ isset($record->due_date) ? \Carbon\Carbon::parse($record->due_date)->format('d M Y') : 'N/A' }}
                                    </td>
                                </tr>
                            </table>
                             
                            <!-- View Record Button -->
                            <div style="margin:25px 0; text-align:center;">
                                <a href="{{ $recordUrl ?? '#' }}" 
                                   style="display:inline-block; background:#5cb85c; color:#ffffff; 
                                          padding:12px 25px; text-decoration:none; border-radius:5px; 
                                          font-weight:bold;">
                                    🔗 Click Here to View {{ $processName ?? 'Record' }}
                                </a>
                            </div>
                            
                            <p>If already completed, please ignore this email.</p>
                            
                            <p>Regards,<br><strong>VidyaGxP System</strong></p>
                            
                         </td>
                     </tr>
                     
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