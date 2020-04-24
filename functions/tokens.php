<?php
function generateToken() {
    $token = "";
    $alphabets = ['a', 'b', 'A', 'B', 'c', 'C', 'd', 'D', 'e', 'E', 'f', 'F', 'g', 'G', 'i', 'I', 'j', 'm', "M", 'y', 'z', 'w', 'Z'];
    
    for ($i = 0; $i < 20; $i++) {
        $index = mt_rand(0, count($alphabets) - 1);
        $token .= $alphabets[$index];
    }
    
    return $token;
}

function find_token($email = ''){
    $allUserTokens = scandir("file_system/tokens/");
    $countAllUserTokens = count($allUserTokens);
    
    for ($counter = 0; $counter < $countAllUserTokens ; $counter++) {
        $currentTokenFile = $allUserTokens[$counter];
        
        if($currentTokenFile == $email . ".json"){
            $tokenContent = file_get_contents("file_system/tokens/".$currentTokenFile);
            $tokenObject = json_decode($tokenContent);
            
            return $tokenObject;
        }
    
    }
    
    return false;
    
}