<?php
include('../config/db.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Pobierz dane z żądania POST
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$service_type = $_POST['service_type'];
$visit_date = $_POST['visit_date'];
$photo_path = null;

// Obsługa przesyłania zdjęcia
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $uploads_dir = '../uploads/';
    $photo_path = $uploads_dir . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);
}

// Wstaw dane do bazy
$stmt = $conn->prepare("INSERT INTO visits (name, email, phone, address, service_type, visit_date, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $phone, $address, $service_type, $visit_date, $photo_path);

if ($stmt->execute()) {
    // Unikalny numer zgłoszenia 
    $unique_number = $conn->insert_id;

    // Funkcja wysyłania e-maila
    try {
        $mail = new PHPMailer(true);

        // Konfiguracja serwera SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = $_ENV['SMTP_ENCRYPTION'];
        $mail->Port = $_ENV['SMTP_PORT'];

        // Odbiorca
        $mail->setFrom($_ENV['SMTP_COMPANY_EMAIL'], 'Twoja Firma');
        $mail->addAddress($email, $name);  // Adres e-mail klienta

        // Treść wiadomości e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Potwierdzenie wizyty';
        $mail->Body = "
            <h2>Potwierdzenie wizyty</h2>
            <p>Witaj $name,</p>
            <p>Twoja wizyta została pomyślnie zapisana.</p>
            <ul>
                <li><strong>Typ usługi:</strong> $service_type</li>
                <li><strong>Data wizyty:</strong> $visit_date</li>
                <li><strong>Adres montażu:</strong> $address</li>
                <li><strong>Numer zgłoszenia:</strong> $unique_number</li>
            </ul>
            <p>Dziękujemy za skorzystanie z naszych usług!</p>
        ";

        // Wyślij e-mail
        $mail->send();
        echo json_encode(["status" => "success", "message" => "Wizyta dodana pomyślnie i e-mail potwierdzający został wysłany"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "warning", "message" => "Wizyta dodana, ale nie udało się wysłać e-maila: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Błąd dodawania wizyty"]);
}

$stmt->close();
$conn->close();
?>
