<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Verification Code</title>
</head>
<body style="margin: 0; padding: 0; background-color: #e7e7e7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #e7e7e7; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width: 460px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">

                    <!-- Logo -->
                    <tr>
                        <td align="center" style="padding: 32px 32px 0;">
                            <a href="{{ url('/') }}" style="text-decoration: none;">
                                <img src="{{ asset('logos/logo.png') }}" alt="SMT Jobs" height="40" style="height: 40px; display: block;">
                            </a>
                        </td>
                    </tr>

                    <!-- Heading -->
                    <tr>
                        <td align="center" style="padding: 24px 32px 8px;">
                            <h1 style="margin: 0; font-size: 22px; font-weight: 700; color: #0f172a;">Verification Code</h1>
                        </td>
                    </tr>

                    <!-- Subtext -->
                    <tr>
                        <td align="center" style="padding: 0 32px 24px;">
                            <p style="margin: 0; font-size: 14px; color: #64748b; line-height: 1.5;">
                                Use the code below to verify your identity on SMT Jobs. This code expires in <strong>5 minutes</strong>.
                            </p>
                        </td>
                    </tr>

                    <!-- OTP Code -->
                    <tr>
                        <td align="center" style="padding: 0 32px 24px;">
                            <div style="display: inline-block; background-color: #f1f5f9; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 16px 40px;">
                                <span style="font-size: 36px; font-weight: 800; letter-spacing: 8px; color: #0f172a; font-family: 'Courier New', monospace;">{{ $otp }}</span>
                            </div>
                        </td>
                    </tr>

                    <!-- Warning -->
                    <tr>
                        <td align="center" style="padding: 0 32px 32px;">
                            <p style="margin: 0; font-size: 12px; color: #94a3b8; line-height: 1.5;">
                                OTPs are SECRET. Do not share this code with anyone.<br>
                                If you didn't request this, please ignore this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding: 0 32px;">
                            <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 0;">
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding: 20px 32px 24px;">
                            <p style="margin: 0; font-size: 11px; color: #94a3b8; line-height: 1.6;">
                                &copy; {{ date('Y') }} SMT Labs Private Limited. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
