<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Transaction</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f5f7;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f5f7; padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="560" cellpadding="0" cellspacing="0" style="max-width:560px; width:100%; background-color:#ffffff; border-radius:10px; overflow:hidden; font-family:Arial,Helvetica,sans-serif;">

                    <!-- Header (brand color) -->
                    <tr>
                        <td style="background-color:#1E88E5; padding:24px 32px;">
                            <h1 style="margin:0; color:#ffffff; font-size:20px; font-weight:bold;">Lanxers</h1>
                            <p style="margin:4px 0 0; color:#e3f0fb; font-size:13px;">Manual Payment Notification</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:28px 32px;">
                            <h2 style="margin:0 0 6px; color:#111827; font-size:18px;">New Manual Transaction Received</h2>
                            <p style="margin:0 0 24px; color:#6b7280; font-size:14px; line-height:1.5;">
                                Ek user ne manual payment complete karke apni Transaction ID submit ki hai. Please details verify karein aur status update karein.
                            </p>

                            <!-- Details table -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #eef0f2; border-radius:8px;">
                                <tr>
                                    <td style="padding:12px 16px; color:#9ca3af; font-size:13px; border-bottom:1px solid #f1f3f5;">User Name</td>
                                    <td style="padding:12px 16px; color:#111827; font-size:14px; font-weight:bold; border-bottom:1px solid #f1f3f5;">{{ $name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; color:#9ca3af; font-size:13px; border-bottom:1px solid #f1f3f5;">User Email</td>
                                    <td style="padding:12px 16px; color:#374151; font-size:14px; border-bottom:1px solid #f1f3f5;">{{ $user_email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; color:#9ca3af; font-size:13px; border-bottom:1px solid #f1f3f5;">User ID</td>
                                    <td style="padding:12px 16px; color:#374151; font-size:14px; border-bottom:1px solid #f1f3f5;">#{{ $user_id }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; color:#9ca3af; font-size:13px; border-bottom:1px solid #f1f3f5;">Transaction ID</td>
                                    <td style="padding:12px 16px; color:#1E88E5; font-size:14px; font-weight:bold; border-bottom:1px solid #f1f3f5;">{{ $transaction_id }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 16px; color:#9ca3af; font-size:13px;">Submitted At</td>
                                    <td style="padding:12px 16px; color:#374151; font-size:14px;">{{ $submitted_at }}</td>
                                </tr>
                            </table>

                            <!-- Status pill -->
                            <p style="margin:24px 0 0; padding:12px 16px; background-color:#fff8e1; border-radius:6px; color:#92400e; font-size:13px; line-height:1.5;">
                                <strong>Status: Pending</strong> &mdash; Admin panel se is transaction ko verify ya reject karein.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:20px 32px; background-color:#fafbfc; border-top:1px solid #eef0f2;">
                            <p style="margin:0; color:#9ca3af; font-size:12px; line-height:1.5;">
                                Yeh ek automated notification hai. Reply karne ki zaroorat nahi.<br>
                                &copy; {{ date('Y') }} Lanxers. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>