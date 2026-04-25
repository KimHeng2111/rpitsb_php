<?php
function generateRandomNameWithDate($originalName) : string {
        // 1. Get the file extension
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        
        // 2. Generate a short random string (8 characters)
        $randomPart = bin2hex(random_bytes(4));
        
        // 3. Get the current date (YYYY-MM-DD)
        $datePart = date("Y-m-d");
        
        // 4. Combine: random_string_2026-04-25.jpg
        return $randomPart . "_" . $datePart . "." . $extension;
    }

?>
