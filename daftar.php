<!DOCTYPE html>
<html lang="en">
<head>
	<title>Daftar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="img/icons/favicon.ico"/>
<!--===============================================================================================-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->

<!--===============================================================================================-->
<!--===============================================================================================-->
<!--===============================================================================================-->	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script type="text/javascript" src="js/jquery.js"></script>
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(img/bg-01.jpg);">
					<span class="login100-form-title-1">
						Daftar
					</span>
				</div>

				<div class="login100-form validate-form" >
					<div class="wrap-input100 validate-input m-b-26" data-validate="Name is required">
						<span class="label-input100">Nama</span>
						<input class="input100 nama" type="text" name="nama" placeholder="Nama" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Email is required">
						<span class="label-input100">Email</span>
						<input class="input100 email" type="email" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
					</div>
						<div class="validasiEmail" style="color:red; font-size:13px; margin-top:-10px;"></div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Handhphone is required">
						<span class="label-input100">Nomor HP</span>
						<input class="input100 hp" type="text" name="noHp" placeholder="Nomor Handphone" required>
						<span class="focus-input100"></span>
					</div>
						<div class="validasiPass" style="color:red; font-size:13px; margin-top:-10px;"></div>


					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100 pass" type="password" name="pass" placeholder="Enter password" required>
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<input type="submit" class="login100-form-btn" value="Daftar" />
							
					
					</div>
				</div>
			</div>
		</div>
	</div>
	
<script type="text/javascript">

	$(document).ready(function(){
		$(".login100-form-btn").click(function(){
			var nama = $(".nama").val();
			var email = $(".email").val();
			var hp = $(".hp").val();
			var pass = $(".pass").val();

			$.ajax({
                        url	     : 'init/init.php?act=daftar',
                        type     : 'POST',
                        dataType : 'html',
                        data     : {'nama': nama, 'email': email, 'noHp': hp, 'pass': pass},
                        success  : function(a){

							
                           if(a === 'Email sudah terdaftar'){
								$('.validasiEmail').html(a);
						   }

						   if(a === 'Nomor ini sudah terdaftar'){
							$('.validasiPass').html(a);
						   }

						   if(a === 'berhasil'){
							document.location='index.php';
						   }
							
                        },
                    })
			
			// alert(nama)
	
			
	})
})

</script>

</body>
</html>