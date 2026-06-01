<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../config/mail.php';

function send_receipt_email(array $booking, string $receipt_url): bool {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = MAIL_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_USERNAME;
        $mail->Password   = MAIL_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = MAIL_PORT;

        $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
        $mail->addAddress($booking['email'], $booking['client_name']);
        $mail->addReplyTo('mdavesulabo@yahoo.com', "Medy's Catering");

        $mail->isHTML(true);
        $mail->Subject = "Booking Confirmation – {$booking['client_id']} | Medy's Catering";
        $mail->Body    = build_email_html($booking, $receipt_url);
        $mail->AltBody = build_email_text($booking, $receipt_url);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error ({$booking['client_id']}): " . $mail->ErrorInfo);
        return false;
    }
}

function _fmt_date_m(string $d): string {
    return $d ? date('F j, Y', strtotime($d)) : '—';
}
function _fmt_time_m(string $t): string {
    return $t ? date('g:i A', strtotime($t)) : '—';
}

function build_email_html(array $b, string $receipt_url): string {
    $qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&format=png&data=' . urlencode($receipt_url);

    $sr_lines = array_filter(array_map('trim', explode("\n", $b['special_requests'] ?? '')));
    $food_line = ''; $addons = []; $requests = [];
    foreach ($sr_lines as $line) {
        if (str_starts_with($line, 'Food Order: ') || preg_match('/^Party Tray \(\d+ Pax\):/', $line)) {
            $food_line = $line;
        } elseif (str_starts_with($line, 'Add-Ons: ')) {
            $addons = array_values(array_filter(array_map('trim', explode(', ', substr($line, 9)))));
        } else {
            $requests[] = $line;
        }
    }

    $dish_html = '';
    if ($food_line) {
        $food_prefix = ''; $food_dishes = '';
        if (preg_match('/^(Party Tray \(\d+ Pax\)):\s*(.+)$/', $food_line, $m)) {
            $food_prefix = $m[1]; $food_dishes = $m[2];
        } elseif (str_starts_with($food_line, 'Food Order: ')) {
            $food_dishes = substr($food_line, 12);
        }
        $dishes = array_values(array_filter(array_map('trim', explode(', ', $food_dishes))));
        $chips  = '';
        if ($food_prefix) {
            $chips .= '<span style="display:inline-block;background:#fee2e2;border:1px solid #fca5a5;border-radius:12px;padding:3px 10px;font-size:12px;font-weight:700;color:#8B1A1A;margin:2px;">' . htmlspecialchars($food_prefix) . '</span> ';
        }
        foreach ($dishes as $d) {
            $chips .= '<span style="display:inline-block;background:#fff;border:1.5px solid #fca5a5;border-radius:12px;padding:3px 10px;font-size:12px;font-weight:600;color:#374151;margin:2px;">' . htmlspecialchars($d) . '</span>';
        }
        $dish_html = '
        <tr>
          <td colspan="2" style="padding:8px 0 0;">
            <div style="background:#fff8f8;border:1.5px solid #c0392b;border-radius:8px;padding:12px 14px;">
              <p style="margin:0 0 8px;font-size:11px;color:#6b7280;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;">Selected Dishes</p>
              <div>' . $chips . '</div>
            </div>
          </td>
        </tr>';
    }

    $addons_html = '';
    if ($addons) {
        $addons_html = '
        <tr>
          <td style="padding:6px 0;font-size:13px;color:#6b7280;vertical-align:top;width:40%;">Add-Ons</td>
          <td style="padding:6px 0;font-size:13px;font-weight:600;color:#111827;">' . htmlspecialchars(implode(' · ', $addons)) . '</td>
        </tr>';
    }

    $requests_html = '';
    if ($requests) {
        $requests_html = '
        <tr>
          <td style="padding:6px 0;font-size:13px;color:#6b7280;vertical-align:top;width:40%;">Special Requests</td>
          <td style="padding:6px 0;font-size:13px;font-weight:600;color:#111827;">' . nl2br(htmlspecialchars(implode("\n", $requests))) . '</td>
        </tr>';
    }

    $rows = [
        ['Event Type',       htmlspecialchars($b['event_type'])],
        ['Event Date',       _fmt_date_m($b['event_date'])],
        ['Event Time',       _fmt_time_m($b['event_time'])],
        ['Number of Guests', htmlspecialchars($b['guest_count'])],
        ['Package',          htmlspecialchars($b['package'])],
        ['Venue',            htmlspecialchars($b['venue'])],
        ['Contact Phone',    htmlspecialchars($b['phone'] ?? '—')],
    ];
    if (!empty($b['duration'])) {
        $rows[] = ['Duration', htmlspecialchars($b['duration'])];
    }

    $detail_rows = '';
    foreach ($rows as [$label, $val]) {
        $detail_rows .= "
        <tr>
          <td style=\"padding:6px 0;font-size:13px;color:#6b7280;width:40%;\">{$label}</td>
          <td style=\"padding:6px 0;font-size:13px;font-weight:600;color:#111827;\">{$val}</td>
        </tr>";
    }

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;padding:0;background:#f9f5f4;font-family:Arial,Helvetica,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f9f5f4;padding:30px 10px;">
<tr><td>
  <table width="600" align="center" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;max-width:600px;box-shadow:0 2px 12px rgba(0,0,0,0.08);">

    <!-- HEADER -->
    <tr>
      <td style="background:#8B1A1A;padding:28px 30px;text-align:center;">
        <h1 style="color:#ffffff;font-size:22px;margin:0;letter-spacing:0.04em;">Medy's Catering</h1>
        <p style="color:rgba(255,255,255,0.75);margin:6px 0 0;font-size:14px;">Booking Confirmation</p>
      </td>
    </tr>

    <!-- GREETING -->
    <tr>
      <td style="padding:24px 30px 0;">
        <p style="margin:0;font-size:15px;color:#111827;">Hi <strong>{$b['client_name']}</strong>,</p>
        <p style="margin:10px 0 0;font-size:14px;color:#374151;line-height:1.6;">
          Thank you for choosing <strong>Medy's Catering!</strong> We have received your booking request and will contact you within <strong>24 hours</strong> to confirm availability.
        </p>
      </td>
    </tr>

    <!-- STATUS BADGE -->
    <tr>
      <td style="padding:16px 30px 0;">
        <div style="background:#fffbeb;border:1.5px solid #fcd34d;border-radius:8px;padding:12px 16px;display:inline-block;width:100%;box-sizing:border-box;">
          <span style="font-size:14px;font-weight:700;color:#d97706;">&#9203; Pending Confirmation</span>
        </div>
      </td>
    </tr>

    <!-- BOOKING REF -->
    <tr>
      <td style="padding:20px 30px 0;">
        <div style="border-bottom:1.5px solid #f0e8e6;padding-bottom:14px;">
          <p style="margin:0 0 3px;font-size:11px;color:#6b7280;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;">Booking Reference</p>
          <p style="margin:0;font-size:24px;font-weight:900;color:#8B1A1A;letter-spacing:0.06em;">{$b['client_id']}</p>
        </div>
      </td>
    </tr>

    <!-- BOOKING DETAILS -->
    <tr>
      <td style="padding:16px 30px 0;">
        <table width="100%" cellpadding="0" cellspacing="0">
          {$detail_rows}
          {$addons_html}
          {$requests_html}
          {$dish_html}
        </table>
      </td>
    </tr>

    <!-- DIVIDER -->
    <tr><td style="padding:20px 30px 0;"><div style="border-top:1.5px solid #f0e8e6;"></div></td></tr>

    <!-- QR CODE -->
    <tr>
      <td style="padding:20px 30px 0;text-align:center;">
        <p style="margin:0 0 12px;font-size:13px;color:#6b7280;">Scan to view your booking receipt anytime</p>
        <img src="{$qr_url}" width="160" height="160" alt="Booking QR Code"
             style="border:4px solid #f0e8e6;border-radius:8px;display:block;margin:0 auto;" />
      </td>
    </tr>

    <!-- VIEW RECEIPT BUTTON -->
    <tr>
      <td style="padding:20px 30px;text-align:center;">
        <a href="{$receipt_url}"
           style="display:inline-block;background:#8B1A1A;color:#ffffff;padding:13px 34px;border-radius:8px;text-decoration:none;font-weight:700;font-size:14px;letter-spacing:0.03em;">
          View Full Receipt
        </a>
      </td>
    </tr>

    <!-- CONTACT NOTE -->
    <tr>
      <td style="padding:0 30px 24px;">
        <div style="background:#f9f5f4;border-radius:8px;padding:14px 16px;font-size:13px;color:#6b7280;line-height:1.65;">
          For questions or changes to your booking, contact us at:<br>
          <strong style="color:#374151;">&#128222; 0999 864 8368</strong> &nbsp;|&nbsp;
          <strong style="color:#374151;">&#9993; mdavesulabo@yahoo.com</strong>
        </div>
      </td>
    </tr>

    <!-- FOOTER -->
    <tr>
      <td style="background:#f0e8e6;padding:16px 30px;text-align:center;font-size:11px;color:#9ca3af;">
        &copy; 2026 Medy's Catering &bull; Trapiche 2, Tanauan City, Batangas &bull; Mon&ndash;Sat 8AM&ndash;5PM
      </td>
    </tr>

  </table>
</td></tr>
</table>
</body>
</html>
HTML;
}

function build_email_text(array $b, string $receipt_url): string {
    return implode("\n", [
        "Medy's Catering – Booking Confirmation",
        str_repeat('=', 40),
        "Hi {$b['client_name']},",
        "",
        "Thank you for choosing Medy's Catering! Your booking request has been received.",
        "We will contact you within 24 hours to confirm availability.",
        "",
        "Booking Reference: {$b['client_id']}",
        "Status: Pending Confirmation",
        "",
        "Event Type : {$b['event_type']}",
        "Event Date : " . _fmt_date_m($b['event_date']),
        "Event Time : " . _fmt_time_m($b['event_time']),
        "Guests     : {$b['guest_count']}",
        "Package    : {$b['package']}",
        "Venue      : {$b['venue']}",
        "Phone      : " . ($b['phone'] ?? '—'),
        "",
        "View your receipt: {$receipt_url}",
        "",
        "For questions: 0999 864 8368 | mdavesulabo@yahoo.com",
        "Mon–Sat 8:00 AM – 5:00 PM",
        "",
        "© 2026 Medy's Catering",
    ]);
}
