<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../models/User.php';
require_once '../vendor/autoload.php';
require_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';

$message = '';
$messageType = '';

// Nilai default dari query string
$to_email = $_POST['to_email'] ?? ($_GET['to_email'] ?? '');
$subject = $_POST['subject'] ?? ($_GET['subject'] ?? '');
$body = $_POST['body'] ?? '';
$reply_to = $_POST['reply_to'] ?? '';

// Proses form jika ada data yang dikirim
if ($_POST) {
    // Validasi input
    if (empty($to_email) || empty($subject) || empty($body)) {
        $message = 'Semua field harus diisi!';
        $messageType = 'danger';
    } elseif (!filter_var($to_email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Format email tidak valid!';
        $messageType = 'danger';
    } else {
        // Kirim email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'muhammadroismauludi@gmail.com';
        $mail->Password = 'meyv oayx cwlo ivit';
        $mail->SMTPSecure = 'tls';
        $mail->setFrom('muhammadroismauludi@gmail.com', 'Sistem Akademik');
        $mail->addAddress($to_email);
        if (filter_var($reply_to, FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($reply_to, 'Pengirim Form');
        }
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = strip_tags($body);
        
        try {
            $mail->send();
            $message = 'Email berhasil dikirim ke ' . htmlspecialchars($to_email) . '!';
            $messageType = 'success';
            // Reset form setelah berhasil
            $to_email = $subject = $body = $reply_to = '';
        } catch (Exception $e) {
            $message = 'Email gagal dikirim: ' . $mail->ErrorInfo;
            $messageType = 'danger';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="index.php" class="text-decoration-none">&larr; Kembali ke Halaman Utama</a>
                    <h1 class="h4 m-0">Kirim Email</h1>
                </div>

                <?php if ($message): ?>
                    <div class="alert alert-<?php echo $messageType; ?> alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($message); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="to_email" class="form-label">Email Tujuan</label>
                                <input type="email" class="form-control" id="to_email" name="to_email" 
                                       value="<?php echo htmlspecialchars($to_email ?? ''); ?>" 
                                       placeholder="contoh@email.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="reply_to" class="form-label">Email Anda (untuk balasan) <span class="text-muted">(opsional)</span></label>
                                <input type="email" class="form-control" id="reply_to" name="reply_to" 
                                       value="<?php echo htmlspecialchars($reply_to ?? ''); ?>" 
                                       placeholder="email@contoh.com">
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" 
                                       value="<?php echo htmlspecialchars($subject ?? ''); ?>" 
                                       placeholder="Masukkan subject email" required>
                            </div>

                            <div class="mb-3">
                                <label for="body" class="form-label">Pesan</label>
                                <textarea class="form-control" id="body" name="body" rows="6"
                                          placeholder="Masukkan pesan email Anda di sini..." required><?php echo htmlspecialchars($body ?? ''); ?></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Kirim Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>