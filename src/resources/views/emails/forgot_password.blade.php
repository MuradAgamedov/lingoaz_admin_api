<!DOCTYPE html>
<html lang="az">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Şifrə Sıfırlama — lingoaz</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f1f5f9;padding:40px 16px;">
  <tr>
    <td align="center">
      <table width="100%" cellpadding="0" cellspacing="0" style="max-width:520px;">

        {{-- Header --}}
        <tr>
          <td align="center" style="background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);border-radius:16px 16px 0 0;padding:40px 32px 32px;">
            <div style="width:64px;height:64px;background:rgba(255,255,255,0.18);border-radius:18px;border:1.5px solid rgba(255,255,255,0.35);display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
              <span style="font-size:32px;line-height:1;">🔐</span>
            </div>
            <div style="font-size:28px;font-weight:800;color:#ffffff;letter-spacing:-0.5px;margin-bottom:6px;">lingoaz</div>
            <div style="font-size:13px;color:rgba(255,255,255,0.75);">Azərbaycan dili öyrənmə platforması</div>
          </td>
        </tr>

        {{-- Body --}}
        <tr>
          <td style="background:#ffffff;padding:40px 40px 32px;border-radius:0 0 16px 16px;">
            <p style="margin:0 0 8px;font-size:22px;font-weight:700;color:#1e293b;">Şifrənizi sıfırlayın</p>
            <p style="margin:0 0 28px;font-size:14px;color:#64748b;line-height:1.6;">
              Şifrənizi sıfırlamaq üçün aşağıdakı OTP kodunu tətbiqdə daxil edin.
              Bu kod <strong>15 dəqiqə</strong> ərzində etibarlıdır.
            </p>

            {{-- OTP Box --}}
            <div style="background:linear-gradient(135deg,#667eea10 0%,#764ba215 100%);border:2px dashed #667eea;border-radius:12px;padding:24px;text-align:center;margin-bottom:28px;">
              <div style="font-size:11px;font-weight:600;color:#667eea;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;">Sıfırlama Kodu</div>
              <div style="font-size:40px;font-weight:800;color:#1e293b;letter-spacing:10px;">{{ $otp }}</div>
            </div>

            <p style="margin:0 0 16px;font-size:13px;color:#94a3b8;line-height:1.5;">
              Əgər bu tələbi siz etməmisinizsə, şifrəniz dəyişdirilməyəcək. Bu e-poçtu görməzdən gəlin.
            </p>

            <hr style="border:none;border-top:1px solid #e2e8f0;margin:24px 0;">

            <p style="margin:0;font-size:12px;color:#94a3b8;text-align:center;">
              © {{ date('Y') }} lingoaz · Bütün hüquqlar qorunur
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
</body>
</html>
