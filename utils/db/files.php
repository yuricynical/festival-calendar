<?php
    class files
    {
        function parseEnvFile($filePath)
        {
            if (!file_exists($filePath)) {
                throw new Exception("File not found: $filePath");
            }
        
            $variables = [];
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
            foreach ($lines as $line) {
                // Skip comments and empty lines
                if (strpos(trim($line), '#') === 0 || trim($line) === '') {
                    continue;
                }
        
                // Split into key and value
                $parts = explode('=', $line, 2);
                if (count($parts) === 2) {
                    $key = trim($parts[0]);
                    $value = trim($parts[1]);
        
                    // Remove quotes if the value is wrapped in single or double quotes
                    if (preg_match('/^["\'].*["\']$/', $value)) {
                        $value = substr($value, 1, -1);
                    }
        
                    $variables[$key] = $value;
                }
            }
        
            return $variables;
        }
    }
?>