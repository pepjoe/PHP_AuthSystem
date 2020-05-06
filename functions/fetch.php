<?php

//fetch appiontment from filing system
function appointment ($department){
    $rows = '';
    $rowNumber = 0;
    $allappointments = scandir("file_system/appointments/"); 
    $countappointments = count($allappointments);
    
    for ($counter = 2; $counter < $countappointments ; $counter++) {
        $appointment = json_decode(file_get_contents('file_system/appointments/' . $allappointments[$counter]));
        
        if ($appointment->department == $department) {
            $rowNumber++;
            $rows .= "
            <tr>
                <th scope='row'>$rowNumber</th>
                <td>$appointment->fullname</td>
                <td>$appointment->noa</td>
                <td>$appointment->date</td>
                <td>$appointment->time</td>
                <td>$appointment->department</td>
                <td>$appointment->complaint</td>
                <td>$appointment->bill</td>
            </tr>
            ";
        }
    }
    
    if ($rows == '') {
        return false;
    }
    return $rows;
}

function getAllstaff() {
    $staffRows = '';
    $staffrowNumber = 0;
    $allusers = scandir('./file_system/users/');
    $num = count($allusers);
    
    for ($counter = 2; $counter < $num; $counter++) {
        $user = json_decode(file_get_contents('./file_system/users/' . $allusers[$counter]));
        
        if (@$user->designation == "Coaching Team") {
            $staffrowNumber++;
            $staffRows .= "
            <tr>
                <th scope='row'>$staffrowNumber</th>
                <td>$user->first_name $user->last_name</td>
                 <td>$user->gender</td>
                <td>$user->designation</td>
                <td>$user->department</td>
                <td>$user->date</td>
            </tr>
            ";
        } 
    }
    return $staffRows;
}

function getAllplayers() {
    $playerRow = '';
    $playerrowNumber = 0;
    $allusers = scandir('./file_system/users/');
    $num = count($allusers);
    
    for ($counter = 2; $counter < $num; $counter++) {
        $user = json_decode(file_get_contents('./file_system/users/' . $allusers[$counter]));
        
        if (@$user->designation == "Player") {
            $playerrowNumber++;
            $playerRow .= "
             <tr>
                <th scope='row'>$playerrowNumber</th>
                <td>$user->first_name $user->last_name</td>
                 <td>$user->gender</td>
                <td>$user->designation</td>
                <td>$user->department</td>
                <td>$user->date</td>
            </tr>
            ";
        } 
    }
    return $playerRow;
}

function payment ($email){
    $rows = '';
    $rowNumber = 0;
    $allpayments = scandir("file_system/payments/");
    $countpayments = count($allpayments);

for ($counter = 2; $counter < $countbills ; $counter++) {
     $payment = json_decode(file_get_contents('file_system/payments/' . $allpayments[$counter]));
 
 
    if ($payment->email == $email) {
        $rowNumber++;
        $rows .= "
         <tr>
            <th scope='row'>$rowNumber</th>
            <td>$payment->date</td>
            <td>$payment->time</td>
            <td>$payment->amount</td>
            <td>$payment->txref</td>
            <td>$payment->email</td>
            <td>$payment->fullname</td>
        </tr>
        ";
    }
}

if ($rows == '') {
    return false;
}
return $rows;
}

//fetch all payments
function getAllpayment()
{

    $txtRow = '';
    $txtrowNumber = 0;
    $alltx = scandir('file_system/payments/');
    $num = count($alltx);
    for ($counter = 2; $counter < $num; $counter++) {
        
        $tx = json_decode(file_get_contents('file_system/payments/' . $alltx[$counter]));
        
        
            $txtrowNumber++;
            $txtRow .= "
            <tr>
            <th scope='row'>$txtrowNumber</th>
            <td>$tx->date</td>
            <td>$tx->time</td>
            <td>$tx->amount</td>
            <td>$tx->txref</td>
            <td>$tx->email</td>
            <td>$tx->fullname</td>
        </tr>
            ";
        
    }
    return $txtRow;
}