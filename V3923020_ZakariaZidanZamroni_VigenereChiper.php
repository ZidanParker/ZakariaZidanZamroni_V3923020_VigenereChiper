<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher</title>
</head>
<body>
    <h2>Enkripsi dan Dekripsi</h2>
    
    <form method="POST" action="">
        <label for="plaintext">Plaintext:</label><br>
        <input type="text" id="plaintext" name="plaintext" required><br><br>
        
        <label for="key">Key:</label><br>
        <input type="text" id="key" name="key" required><br><br>
        
        <input type="submit" name="action" value="Encrypt">
        <input type="submit" name="action" value="Decrypt">
    </form>

    <?php
    function vigenere_encrypt($plaintext, $key) {
        $ciphertext = "";
        $key = strtoupper($key);
        $key_len = strlen($key);
        $key_index = 0;

        for ($i = 0; $i < strlen($plaintext); $i++) {
            $char = $plaintext[$i];

            if (ctype_alpha($char)) {
                $shift = ord($key[$key_index % $key_len]) - ord('A');

                if (ctype_lower($char)) {
                    $ciphertext .= chr(((ord($char) - ord('a') + $shift) % 26) + ord('a'));
                } else {
                    $ciphertext .= chr(((ord($char) - ord('A') + $shift) % 26) + ord('A'));
                }

                $key_index++;
            } else {
                $ciphertext .= $char;
            }
        }
        return $ciphertext;
    }

    function vigenere_decrypt($ciphertext, $key) {
        $plaintext = "";
        $key = strtoupper($key);
        $key_len = strlen($key);
        $key_index = 0;

        for ($i = 0; $i < strlen($ciphertext); $i++) {
            $char = $ciphertext[$i];

            if (ctype_alpha($char)) {
                $shift = ord($key[$key_index % $key_len]) - ord('A');

                if (ctype_lower($char)) {
                    $plaintext .= chr(((ord($char) - ord('a') - $shift + 26) % 26) + ord('a'));
                } else {
                    $plaintext .= chr(((ord($char) - ord('A') - $shift + 26) % 26) + ord('A'));
                }

                $key_index++;
            } else {
                $plaintext .= $char;
            }
        }
        return $plaintext;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $plaintext = $_POST['plaintext'];
        $key = $_POST['key'];

        if ($_POST['action'] == 'Encrypt') {
            $result = vigenere_encrypt($plaintext, $key);
            echo "<h3>Encrypted Text: </h3><p>$result</p>";
        } elseif ($_POST['action'] == 'Decrypt') {
            $result = vigenere_decrypt($plaintext, $key);
            echo "<h3>Decrypted Text: </h3><p>$result</p>";
        }
    }
    ?>
</body>
</html>
