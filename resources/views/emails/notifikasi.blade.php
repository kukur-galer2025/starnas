<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body style="margin:0;padding:24px 12px;background:#f1f5f4;font-family:Arial,Helvetica,sans-serif;color:#1f2937;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr><td align="center">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px;background:#ffffff;border-radius:12px;overflow:hidden;">
                <tr><td style="background:#065f46;padding:20px 28px;color:#ffffff;">
                    <div style="font-size:12px;letter-spacing:1px;color:#6ee7b7;">STARNAS Series ke-5 &bull; ICoABCD Series ke-4</div>
                    <div style="font-size:20px;font-weight:bold;margin-top:4px;">STARNAS ASASI &amp; ICoABCD 2026</div>
                </td></tr>
                <tr><td style="padding:28px;">
                    <p style="margin:0 0 12px;">Yth. <strong>{{ $nama }}</strong>,</p>
                    <h2 style="margin:0 0 16px;font-size:18px;color:#065f46;">{{ $judul }}</h2>
                    @foreach($baris as $b)
                        <p style="margin:0 0 12px;line-height:1.6;">{{ $b }}</p>
                    @endforeach
                    @if($catatan)
                        <div style="margin:16px 0;padding:12px 16px;background:#f0fdf4;border-left:4px solid #10b981;border-radius:6px;font-size:14px;">
                            <strong>Catatan:</strong><br>{{ $catatan }}
                        </div>
                    @endif
                    @if($tombolUrl)
                        <p style="margin:24px 0;"><a href="{{ $tombolUrl }}" style="background:#059669;color:#ffffff;text-decoration:none;padding:12px 22px;border-radius:8px;font-weight:bold;display:inline-block;">{{ $tombolTeks }}</a></p>
                    @endif
                    <p style="margin:24px 0 0;font-size:13px;color:#6b7280;">1-2 Desember 2026 &bull; Grand Hotel De Djokja, Yogyakarta</p>
                </td></tr>
                <tr><td style="padding:16px 28px;background:#f9fafb;font-size:12px;color:#9ca3af;">
                    Email ini dikirim otomatis, mohon tidak membalas langsung.
                </td></tr>
            </table>
        </td></tr>
    </table>
</body>
</html>
