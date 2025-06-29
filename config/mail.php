<?php
$to_email = "jehil12829@ofacer.com";
$subject = "Test Email from Raw PHP";
$body = "Hello,\nThis is a test email sent via Gmail SMTP using raw PHP.";
$from_email = "mdarikrayhan@gmail.com";
$app_password = "aeezmayolqnnzvyc"; // Gmail App Password

// Connect via SSL
$hostname = 'ssl://smtp.gmail.com';
$port = 465;
$timeout = 30;

$socket = stream_socket_client("$hostname:$port", $errno, $errstr, $timeout);
if (!$socket) {
    die("Connection failed: $errno - $errstr\n");
} else {
    echo "Connected to $hostname on port $port\n";
}

function send_cmd($socket, $cmd, $debug = false)
{
    fwrite($socket, $cmd . "\r\n");
    $response = '';
    while ($line = fgets($socket, 512)) {
        $response .= $line;
        if (preg_match('/^\d{3} /', $line))
            break;
    }
    if ($debug)
        echo "C: $cmd\nS: $response\n";
    return $response;
}   

// Read server greeting
fgets($socket);

// Say EHLO
send_cmd($socket, "EHLO localhost", true);

// Authenticate
send_cmd($socket, "AUTH LOGIN", true);
send_cmd($socket, base64_encode($from_email), true);
send_cmd($socket, base64_encode($app_password), true);

// Send mail
send_cmd($socket, "MAIL FROM:<$from_email>", true);
send_cmd($socket, "RCPT TO:<$to_email>", true);
send_cmd($socket, "DATA", true);

// Construct message
$message = "To: $to_email\r\n";
$message .= "From: $from_email\r\n";
$message .= "Subject: $subject\r\n";
$message .= "Content-Type: text/plain; charset=UTF-8\r\n";
$message .= "\r\n";
$message .= $body;

// End message with a dot on a line
send_cmd($socket, $message . "\r\n.", true);

// Quit
send_cmd($socket, "QUIT", true);

fclose($socket);

echo "Email sent successfully.\n";
?>



<!-- Email Sending using mail function for which postfix and sendmail is needed -->
<?php
// $to = 'mdarikrayhan@gmail.com';
// $subject = 'Test email from PHP on macOS';
// $message = 'This is a test email using Postfix and Gmail SMTP';
// $headers = 'From: your_email@gmail.com' . "\r\n" .
//     'Reply-To: your_email@gmail.com' . "\r\n" .
//     'X-Mailer: PHP/' . phpversion();

// if (mail($to, $subject, $message, $headers)) {
//     echo 'Email sent successfully.';
// } else {
//     echo 'Failed to send email.';
// }
?>