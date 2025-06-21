<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Anda - SemMeet</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            padding: 20px;
            margin: 0;
            line-height: 1.6;
            color: #333;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: #2563eb;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            color: #ffffff;
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
        }
        
        .message {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 30px;
        }
        
        .otp-container {
            background-color: #f8fafc;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        
        .otp-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 15px;
            font-weight: 500;
        }
        
        .otp-code {
            font-size: 32px;
            font-weight: 700;
            color: #2563eb;
            letter-spacing: 6px;
            font-family: 'Courier New', monospace;
            margin: 15px 0;
        }
        
        .validity-info {
            background: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 6px;
            padding: 15px;
            margin: 25px 0;
            color: #92400e;
            font-size: 14px;
        }
        
        .security-note {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
            color: #1e40af;
            font-size: 14px;
        }
        
        .security-note strong {
            color: #1d4ed8;
        }
        
        .footer {
            background: #f9fafb;
            padding: 25px 30px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }
        
        .footer p {
            margin: 8px 0;
            font-size: 13px;
            color: #6b7280;
        }
        
        .company-name {
            font-weight: 600;
            color: #2563eb;
        }
        
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .header {
                padding: 25px 20px;
            }
            
            .otp-code {
                font-size: 28px;
                letter-spacing: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>SemMeet</h1>
        </div>
        
        <!-- Content -->
        <div class="content">
            <h2 class="greeting">Halo! Selamat Datang Di SemMeet</h2>
            <p class="message">
                Terima kasih telah memakai SemMeet. Berikut adalah kode OTP Anda:
            </p>
            
            <!-- OTP Container -->
            <div class="otp-container">
                <div class="otp-label">Kode Verifikasi OTP</div>
                <div class="otp-code">{{ $otp }}</div>
            </div>
            
            <div class="validity-info">
                <strong>Penting:</strong> Kode OTP ini berlaku selama <strong>10 menit</strong>.
            </div>
            
            <div class="security-note">
                <strong>Keamanan:</strong> Jika Anda tidak meminta kode ini, abaikan email ini. Jangan bagikan kode OTP kepada siapa pun.
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p class="company-name">SemMeet</p>
            <p>Email ini dikirim secara otomatis oleh sistem kami.</p>
            <p>Jangan balas email ini.</p>
        </div>
    </div>
</body>
</html>