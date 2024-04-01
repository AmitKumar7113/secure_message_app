<?php
require_once "../db/conn.php";

class EncryptedMessage {
    private string $text;
    private string $recipient;
    private string $createdAt;
    private int $expiryTime;
    private string $decryptionKey;
    private bool $isRead = false;

    public function __construct(string $text, string $recipient, string $createdAt) {
        $this->text = $text;
        $this->recipient = $recipient;
        $this->createdAt = $createdAt;
    }

    public function encryptMessage(string $encryptionKey): string {
        return openssl_encrypt($this->text, 'aes-256-cbc', $encryptionKey, 0, $this->createdAt);
    }

    public function decryptMessage(string $encryptedText, string $decryptionKey): ?string {
        $decryptedText = openssl_decrypt($encryptedText, 'aes-256-cbc', $decryptionKey, 0, $this->createdAt);
        
        if ($decryptedText !== false) {
            $this->isRead = true;
            return $decryptedText;
        } else {
            return null; // Decryption failed
        }
    }

    public function isExpired(): bool {
        $now = time();
        return $now > strtotime("+$this->expiryTime minutes", strtotime($this->createdAt));
    }

    public function isRead(): bool {
        return $this->isRead;
    }

    // Getter method for recipient
    public function getRecipient(): string {
        return $this->recipient;
    }

    // Getter method for createdAt
    public function getCreatedAt(): string {
        return $this->createdAt;
    }

}

function setNewUser($name, $email, $decryptionKey, $conn) {
    // Check if the email already exists
    $sql_check_email = "SELECT * FROM users WHERE email = '$email'";
    $result_check_email = $conn->query($sql_check_email);

    if ($result_check_email->num_rows > 0) {
        // Email already exists
        return "Email already exists. Please choose a different email address.";
    } else {
        // Sanitize inputs
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $decryptionKey = $conn->real_escape_string($decryptionKey);
        
        // Insert new user into the database
        $sql_insert_user = "INSERT INTO users (name, email, decrypt_key) VALUES ('$name', '$email', '$decryptionKey')";
        
        if ($conn->query($sql_insert_user) === TRUE) {
            // User inserted successfully
            return "User created successfully.";
        } else {
            // Error inserting user
            return "Error creating user: " . $conn->error;
        }
    }
}



function saveMessageToDatabase(EncryptedMessage $message, $conn): bool {
    $text = $conn->real_escape_string($message->encryptMessage("super_secret_key")); // Encrypt message before storing
    $recipient = $conn->real_escape_string($message->getRecipient());
    $createdAt = $conn->real_escape_string($message->getCreatedAt());
    
    // Check if the recipient exists in the users table
    $checkUserQuery = "SELECT * FROM users WHERE email = '$recipient'";
    $userResult = $conn->query($checkUserQuery);
    if (!$userResult || $userResult->num_rows === 0) {
        // Recipient email does not exist in the users table
        return false;
    }
        
    $sql = "INSERT INTO messages (text, recipient, created_at) 
            VALUES ('$text', '$recipient', '$createdAt')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return false;
    }
}

function getMessageFromDatabase(string $email, $conn, string $decryptionKey): array {
    // Check if the email exists in the users table
    $checkUserQuery = "SELECT * FROM users WHERE email = '$email' AND decrypt_key = '$decryptionKey'";
    $userResult = $conn->query($checkUserQuery);
    if (!$userResult || $userResult->num_rows === 0) {
        // Email does not exist in the users table
        return [];
    } 

    $sql = "SELECT * FROM messages WHERE recipient = '$email' AND status != 0";
    $result = $conn->query($sql);
    $messages = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['status'] != 0) {
                $text = openssl_decrypt($row['text'], 'aes-256-cbc', "super_secret_key", 0, $row['created_at']); // Decrypt stored message
                $messageId = $row['id'];
                $recipient = $row['recipient'];
                $createdAt = $row['created_at'];
                $expiryTime = $row['expiry_time'];
                
                // Check if message has expired
                $expiryTimestamp = strtotime("$createdAt +$expiryTime minutes");
                $currentTimestamp = time();
                if ($currentTimestamp > $expiryTimestamp) {
                    // Message has expired, update status to 0
                    $sql = "UPDATE messages SET status = 0 WHERE id = '$messageId'";
                    $conn->query($sql);
                } else {
                    $messages[] = new EncryptedMessage($text, $recipient, $createdAt);
                }
            }
        }
    }
    return $messages;
}


// Handling message sending
if (isset($_POST['send'])) {
    $text = $_POST['message'];
    $recipient = $_POST['recipient'];
    $createdAt = date("Y-m-d H:i:s");
    $message = new EncryptedMessage($text, $recipient, $createdAt);
    
    if (saveMessageToDatabase($message, $conn)) {
        $successMessage = "Message sent successfully.";
    } else {
        // Failed to send message
        $errorMessage = "Failed to send message please check email.";
    }
}


if (isset($_POST['createuser'])) {

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $decryptionKey = $_POST['decryption_key'];

    // Call setNewUser function
    $result = setNewUser($name, $email, $decryptionKey, $conn);
    
    // Set success or error message based on result
    if (strpos($result, "successfully") !== false) {
        $successMessage = $result;
    } else {
        $errorMessage = $result;
    }
}

// Handling message reading
if (isset($_POST['read'])) {
    $email = $_POST['email'];
    $decryptionKey = $_POST['decryption_key'];
    
    $messages = getMessageFromDatabase($email, $conn, $decryptionKey);

    if (!empty($messages)) {
        echo "<div class='alert alert-success' role='alert'>";
        echo "<h4>Decrypted Messages for  $email </h4>";
        foreach ($messages as $message) {
            $decryptedText = $message->decryptMessage($message->encryptMessage("super_secret_key"), "super_secret_key");
            if ($decryptedText !== null) {
                echo "<p>=> $decryptedText</p>";
            } else {            
                echo "<p>Error: Failed to decrypt message.</p>";
            }
        }
        echo "</div>";
        // Update the status or delete the messages from the database
        $sql = "UPDATE messages SET status = 0 WHERE recipient = '$email'";
        $conn->query($sql);
        
    } else {
        echo "
        <div class='error-message'>
            <p class='text-center py-2'>Error: No messages found for the given email.</p>
        </div>
        ";
        // Back button to the previous page
    }
}

$conn->close();
?>
