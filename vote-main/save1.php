<?php
ini_set('display_errors', 'On');

$key = 'hai,namasayaiqbal,umur23tahunlahir31011997.andthisismyfypprojecton2020.thankyou.';

function encryptthis($data,$key){
    $ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($data, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    $cdata = base64_encode( $iv.$hmac.$ciphertext_raw );
    return $cdata;}

function decryptthis($cdata,$key){
$c = base64_decode($cdata);
$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
$iv = substr($c, 0, $ivlen);
$hmac = substr($c, $ivlen, $sha2len=32);
$ciphertext_raw = substr($c, $ivlen+$sha2len);
$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
{
    return $original_plaintext;
  }
}

error_reporting(E_ALL);
require('connection.php');
 $vote = $_REQUEST['vote'];
  $user_id=$_REQUEST['user_id'];
   $position=$_REQUEST['position'];

$sql=mysqli_query($con, "SELECT position,voter_id FROM tblvotes where position='$position' and voter_id='$user_id'");

if(mysqli_num_rows($sql))
{
    echo "<h3>You have already done your vote for this Position</h3>";

}
else
{
    //insert data and check position
    $ins=mysqli_query($con,"INSERT INTO tblvotes (voter_id, position, candidateName) VALUES ('$user_id', '$position', '$vote')");
    $check = mysqli_query($con, "SELECT * FROM tbcandidates WHERE candidate_name='$vote'");
    $row=mysqli_fetch_assoc($check);
    echo $row['candidate_cvotes'];
    mysqli_query($con, "UPDATE tbcandidates SET candidate_cvotes=candidate_cvotes+1 WHERE candidate_id='$vote'");
    mysqli_close($con);

echo "<h3 style='color:blue'>Congrats, You have submitted your vote for canditate ".$vote."</h3>";

}

?>
