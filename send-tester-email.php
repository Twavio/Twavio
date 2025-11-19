<?php
// Beta-Tester-Anmeldung E-Mail-Versand
// Sendet E-Mails an Admin und Tester

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Nur POST-Requests erlauben
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Nur POST-Requests erlaubt']);
    exit;
}

// Formulardaten erhalten
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$device = isset($_POST['device']) ? trim($_POST['device']) : '';
$motivation = isset($_POST['motivation']) ? trim($_POST['motivation']) : '';
$newsletter = isset($_POST['newsletter']) ? 'Ja' : 'Nein';

// Validierung
if (empty($name) || empty($email) || empty($device) || empty($motivation)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Bitte fülle alle Pflichtfelder aus']);
    exit;
}

// E-Mail-Validierung
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Ungültige E-Mail-Adresse']);
    exit;
}

// E-Mail-Einstellungen
$admin_email = 'info@twavio.com';
$admin_name = 'Twavio Team';
$timestamp = date('d.m.Y H:i:s');

// E-Mail an Admin (info@twavio.com)
$admin_subject = "Neue Beta-Tester-Anmeldung: " . $name;
$admin_message = "Neue Beta-Tester-Anmeldung für Twavio\n\n";
$admin_message .= "Name: " . $name . "\n";
$admin_message .= "E-Mail: " . $email . "\n";
$admin_message .= "Telefon: " . ($phone ? $phone : 'Nicht angegeben') . "\n";
$admin_message .= "Gerät: " . $device . "\n";
$admin_message .= "Newsletter: " . $newsletter . "\n\n";
$admin_message .= "Motivation:\n" . $motivation . "\n\n";
$admin_message .= "---\n";
$admin_message .= "Anmeldedatum: " . $timestamp . "\n";
$admin_message .= "Diese E-Mail wurde automatisch über das Beta-Tester-Anmeldeformular gesendet.";

$admin_headers = "From: " . $admin_name . " <" . $admin_email . ">\r\n";
$admin_headers .= "Reply-To: " . $email . "\r\n";
$admin_headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$admin_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Bestätigungs-E-Mail an Tester
$tester_subject = "Beta-Tester-Anmeldung erhalten - Twavio";
$tester_message = "Hallo " . $name . ",\n\n";
$tester_message .= "vielen Dank für dein Interesse an Twavio!\n\n";
$tester_message .= "Wir haben deine Anmeldung als Beta-Tester erhalten und freuen uns sehr, dass du uns bei der Entwicklung helfen möchtest.\n\n";
$tester_message .= "Deine Anmeldedaten:\n";
$tester_message .= "- Name: " . $name . "\n";
$tester_message .= "- E-Mail: " . $email . "\n";
$tester_message .= "- Gerät: " . $device . "\n";
$tester_message .= "- Anmeldedatum: " . $timestamp . "\n\n";

if ($newsletter === 'Ja') {
    $tester_message .= "Du wirst über Neuigkeiten und Updates per E-Mail informiert.\n\n";
}

$tester_message .= "Wir werden uns in Kürze bei dir melden, sobald die Beta-Version verfügbar ist.\n\n";
$tester_message .= "Bis dahin kannst du uns jederzeit unter " . $admin_email . " erreichen.\n\n";
$tester_message .= "Viele Grüße\n";
$tester_message .= "Das Twavio Team\n\n";
$tester_message .= "---\n";
$tester_message .= "Twavio - Gemeinsam reisen, gemeinsam erleben\n";
$tester_message .= $admin_email . "\n";
$tester_message .= "https://twavio.com";

$tester_headers = "From: " . $admin_name . " <" . $admin_email . ">\r\n";
$tester_headers .= "Reply-To: " . $admin_email . "\r\n";
$tester_headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$tester_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// E-Mails versenden
$admin_sent = @mail($admin_email, $admin_subject, $admin_message, $admin_headers);
$tester_sent = @mail($email, $tester_subject, $tester_message, $tester_headers);

if ($admin_sent && $tester_sent) {
    http_response_code(200);
    echo json_encode([
        'success' => true, 
        'message' => 'Anmeldung erfolgreich! Du erhältst gleich eine Bestätigungs-E-Mail.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Fehler beim Versenden der E-Mail. Bitte versuche es später erneut oder kontaktiere uns direkt unter ' . $admin_email
    ]);
}
?>

