<?php
 // --- GEMINI EMAIL ANALYSIS HELPER ---
function analyse_email_with_gemini(string $sender, string $subject, string $body, array $attachments): array {
    $apiKey = 'AIzaSyBu_79iDKZ5BaDU2d0wUXiYHqMLP5H5t54';
    // base URL WITHOUT ?key
    $url    = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

    $attachmentDesc = empty($attachments)
        ? "none"
        : implode(', ', $attachments);

    // Prompt: ask clearly for structured JSON
    $prompt = "You are a security assistant. Analyse the following email for phishing or scam.\n"
            . "Consider sender, subject, body and attachment types.\n"
            . "Respond ONLY with a valid JSON object, no extra text, with this structure:\n"
            . "{\n"
            . "  \"risk_level\": \"low\" | \"medium\" | \"high\",\n"
            . "  \"reasons\": [\"short bullet reason 1\", \"short bullet reason 2\", ...],\n"
            . "  \"advice\": \"one short sentence of advice for the user\"\n"
            . "}\n";

    // We put the actual email details in a separate part to keep prompt clean
    $emailDetails = "Sender: {$sender}\n"
                  . "Subject: {$subject}\n"
                  . "Attachments (types): {$attachmentDesc}\n"
                  . "Body:\n{$body}";

    $payload = [
        'contents' => [[
            'parts' => [
                ['text' => $prompt],
                ['text' => $emailDetails],
            ],
        ]],
        'generationConfig' => [
            'response_mime_type' => 'application/json',
        ],
    ];

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $url . '?key=' . urlencode($apiKey),
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_TIMEOUT        => 20,
    ]);

    $rawResponse = curl_exec($ch);
    if ($rawResponse === false) {
        $err = curl_error($ch);
        curl_close($ch);
        echo '<pre style="color:white;">Gemini CURL error: ' . htmlspecialchars($err) . '</pre>';
        return [
            'risk_level' => 'unknown',
            'reasons'    => ['Failed to contact AI service (curl error).'],
            'advice'     => 'Try again later and be cautious with this email.'
        ];
    }
    curl_close($ch);

    $data = json_decode($rawResponse, true);

    // If API returned an error it shows in the UI
    if (isset($data['error'])) {
        $msg   = $data['error']['message'] ?? 'Unknown error from Gemini API.';
        $code  = $data['error']['code'] ?? 0;
        $status= $data['error']['status'] ?? '';

        return [
            'risk_level' => 'unknown',
            'reasons'    => ["Gemini API error ({$code} {$status}): {$msg}"],
            'advice'     => 'AI analysis is temporarily unavailable. Be careful with this email.'
        ];
    }

    // Normal success path: Gemini responds with content
    $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

    // 1) Try direct JSON
    $parsed = json_decode($text, true);

    // 2) If that fails, try to extract a JSON object {...} from the text
    if (!is_array($parsed) || !isset($parsed['risk_level'])) {
        if (preg_match('/\{.*\}/s', $text, $m)) {
            $parsed = json_decode($m[0], true);
        }
    }

    // 3) If we have a JSON object with risk_level, use it
    if (is_array($parsed) && isset($parsed['risk_level'])) {
        return [
            'risk_level' => $parsed['risk_level'] ?? 'unknown',
            'reasons'    => $parsed['reasons'] ?? [],
            'advice'     => $parsed['advice'] ?? '',
        ];
    }

    // 4) Otherwise, treat whole text as explanation and guess a risk level by keywords
    $lc = strtolower($text);
    $risk = 'unknown';
    if (strpos($lc, 'high risk') !== false || strpos($lc, 'very risky') !== false) {
        $risk = 'high';
    } elseif (strpos($lc, 'medium risk') !== false || strpos($lc, 'somewhat suspicious') !== false) {
        $risk = 'medium';
    } elseif (strpos($lc, 'low risk') !== false || strpos($lc, 'likely legitimate') !== false) {
        $risk = 'low';
    }

    return [
        'risk_level' => $risk,
        'reasons'    => [$text !== '' ? $text : 'AI returned an unexpected response.'],
        'advice'     => 'Be careful with this email. Do not click unknown links or provide personal data.'
    ];
}
$type   = $_POST['type'] ?? '';
$result = '';
switch ($type) {
    case 'phone':
        $phone = $_POST['phone'] ?? '';
        $result = "Received phone number: " . htmlspecialchars($phone);
        break;
    case 'url':
        $url = $_POST['url'] ?? '';
        $result = "Received URL: " . htmlspecialchars($url);
        break;
        case 'email':
        $email_address = $_POST['email_address'] ?? '';
        $email_subject = $_POST['email_subject'] ?? '';
        $email_content = $_POST['email_content'] ?? '';
        $attachments   = $_POST['attachments'] ?? []; // array of types or empty

        // Call Gemini AI to analyse the email
        $analysis = analyse_email_with_gemini($email_address, $email_subject, $email_content, $attachments);

        // Build HTML output
        ob_start();
        ?>
        <h3 class="mb-3 text-uppercase font-weight-bold">AI EMAIL ANALYSIS</h3>

        <?php
        $level = strtolower($analysis['risk_level']);
        $badgeClass =
            $level === 'high'   ? 'bg-danger' :
            ($level === 'medium' ? 'bg-warning text-dark' :
            ($level === 'low'    ? 'bg-success' : 'bg-secondary'));
        ?>
        <p>
            <strong class="text-uppercase font-weight-bold">RISK LEVEL:</strong>
            <span class="badge <?php echo $badgeClass; ?>">
                <?php echo htmlspecialchars($analysis['risk_level']); ?>
            </span>
        </p>

        <?php if (!empty($analysis['reasons'])): ?>
            <h5 class="text-uppercase font-weight-bold">REASONS DETECTED:</h5>
            <ul>
                <?php foreach ($analysis['reasons'] as $reason): ?>
                    <li><?php echo htmlspecialchars($reason); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($analysis['advice'])): ?>
            <h5 class="text-uppercase font-weight-bold">ADVICE:</h5>
            <p><?php echo nl2br(htmlspecialchars($analysis['advice'])); ?></p>
        <?php endif; ?>

        <hr>
        <h5 class="text-uppercase font-weight-bold">ORIGINAL EMAIL</h5>
        <p><strong>From:</strong> <?php echo htmlspecialchars($email_address); ?></p>
        <p><strong>Subject:</strong> <?php echo htmlspecialchars($email_subject); ?></p>

        <?php
        $attachmentLabel = empty($attachments)
            ? 'None'
            : implode(', ', array_map('htmlspecialchars', $attachments));
        ?>
        <p><strong>Attachments (types):</strong> <?php echo $attachmentLabel; ?></p>

        <pre class="text-white bg-secondary p-3" style="white-space: pre-wrap; border-radius: 0.25rem;">
        <?php echo htmlspecialchars($email_content); ?>
        </pre>
        <?php
        $result = ob_get_clean();
        break;
    default:
        $result = "Unknown scan type.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scan Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
          rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">
    <div class="container py-5">
        <h1>Scan Result</h1>
        <div class="alert alert-secondary bg-secondary text-white" role="alert">
            <?php echo $result; ?>
        </div>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>