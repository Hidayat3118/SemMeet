<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kode OTP Anda</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #2c3e50;">Halo! Selamat Di SeemMeet</h2>
        <p style="font-size: 16px;">Terima kasih telah memakai SeemMeet. Berikut adalah kode OTP Anda:</p>

        <div style="margin: 20px 0; text-align: center;">
            <span style="display: inline-block; background-color: #f0f0f0; padding: 15px 25px; font-size: 24px; font-weight: bold; border-radius: 6px; color: #2c3e50;">
                {{ $otp }}
            </span>
        </div>

        <p style="font-size: 14px; color: #666;">Kode OTP ini berlaku selama <strong>10 menit</strong>.</p>
        <p style="font-size: 14px; color: #666;">Jika Anda tidak meminta kode ini, abaikan email ini.</p>

        <hr style="margin: 30px 0;">
        <p style="font-size: 12px; color: #999;">Email ini dikirim secara otomatis oleh sistem kami. Jangan balas email ini.</p>
    </div>
</body>
</html>
