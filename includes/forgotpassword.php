<?php
if(isset($_POST['update']))
  {
$nim=$_POST['nim'];
$nama_lengkap=$_POST['nama_lengkap'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT nim FROM mhs WHERE nim=:nim and nama_lengkap=:nama_lengkap";
$query= $dbh -> prepare($sql);
$query-> bindParam(':nim', $nim, PDO::PARAM_STR);
$query-> bindParam(':nama_lengkap', $nama_lengkap, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update mhs set Password=:newpassword where nim=:nim and nama_lengkap=:nama_lengkap";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':nim', $nim, PDO::PARAM_STR);
$chngpwd1-> bindParam(':nama_lengkap', $nama_lengkap, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
}

?>
  <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
<div class="modal fade" id="forgotpassword">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Password Recovery</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="forgotpassword_wrap">
            <div class="col-md-12">
              <form name="chngpwd" method="post" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" name="nim" class="form-control" placeholder="NIM*" required="">
                </div>
  <div class="form-group">
                  <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap*" required="">
                </div>

  <div class="form-group">
                  <input type="password" name="newpassword" class="form-control" placeholder="New Password*" required="">
                </div>
  <div class="form-group">
                  <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password*" required="">
                </div>
                <div class="form-group">
                  <input type="submit" value="Reset Password" name="update" class="btn btn-block">
                </div>
              </form>
              <div class="text-center">
                <p class="gray_text">
Untuk alasan keamanan, kami tidak menyimpan kata sandi Anda. Kata sandi Anda akan diatur ulang dan yang baru akan dikirimkan.</p>
                <p><a href="#loginform" data-toggle="modal" data-dismiss="modal"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Login</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>