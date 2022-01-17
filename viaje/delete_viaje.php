<?php  
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
<<<<<<< HEAD
        $url = 'https://blablacariw.herokuapp.com//travels/delete';
=======
        $url = 'https://blablacariw.herokuapp.com/travels/delete';
>>>>>>> 46687286e0d79afa105bf5d92cf4dd17f2aac34d
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $data = array(
            "id" => $_POST['id']
        );

        $json = json_encode($data);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch); 
        $result = json_decode($output);
        
        $_SESSION['server_msg'] = $result->data->msg;
    }
    header('Location: ../myaccount.php');
?>