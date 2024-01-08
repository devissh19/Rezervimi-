<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = $_POST["emri"];
    $mbiemri = $_POST["mbiemri"];
    $telefoni = $_POST["telefoni"];
    $data_mberritjes = $_POST["data_mberritjes"];
    $muaji = $_POST["muaji"];

    // Array me çmimet për secilin muaj
    $cmimet = array(
        "Janar" => 100,
        "Shkurt" => 120,
        "Mars" => 110,
        "Prill" => 115,
        "Maj" => 105,
        "Qershor" => 125,
        "Korrik" => 130,
        "Gusht" => 135,
        "Shtator" => 110,
        "Tetor" => 115,
        "Nentor" => 120,
        "Dhjetor" => 140
        // Shtoni çmimet për muajt e tjera këtu
    );

    // Informacioni për emailin
    $to = "devis.sherifaj@umsh.edu.al";
    $subject = "Rezervim i apartamentit për $muaji";
    $message = "Emri: $emri\n";
    $message .= "Mbiemri: $mbiemri\n";
    $message .= "Numri i telefonit: $telefoni\n";
    $message .= "Data e mbërritjes: $data_mberritjes\n";
    $message .= "Muaji i zgjedhur për qiraj: $muaji\n";
    $message .= "Çmimi për muajin e zgjedhur: " . $cmimet[$muaji] . " EUR\n";

    // Dërgimi i emailit përmes PHP Mailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php'; // Rregulloni saktësisht rrugën e skedarit PHPMailer

    $mail = new PHPMailer(true);
    try {
        // Konfigurimi i serverit
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'adresa_juaj@gmail.com'; //Ndryshoni këtë me adresën tuaj të vërtetë të Gmail-it
        $mail->Password = 'fjalkalimi_juaj'; //Ndryshoni këtë me fjalëkalimin tuaj të vërtetë të Gmail-it
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Informacionet e mesazhit
        $mail->setFrom('adresa_juaj@gmail.com', 'Emri Juaj'); //Ndryshoni këtë me adresën dhe emrin tuaj të vërtetë të Gmail-it
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Dërgimi i emailit
        $mail->send();
        echo 'Emaili është dërguar me sukses!';
    } catch (Exception $e) {
        echo "Emaili nuk mund të dërgohet. Gabimi: {$mail->ErrorInfo}";
    }
}
?>
