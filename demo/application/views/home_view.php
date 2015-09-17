<html>
<head>
	<title>Facebook authentication library for codeigniter</title>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
          
</head>
<body>
	<div align="center">
		<h2>Facebook authentication library for Codeigniter</h2>
	</div>
	<?php if($this->session->flashdata('message')) {?>
            <div class="alert alert-warning" role="alert"><?=$this->session->flashdata('message');?></div>
            <?php }?>
	<div class="container">
		<div class="row">	
			<div class="col s12 m6 offset-m3 l6 offset-l3">
				<?php 
				if($this->session->userdata('sess_logged_in')==0){?>
					<a href="<?=$facebook_login_url?>"class="waves-effect waves-light btn indigo darken-3"><i class="fa fa-facebook left"></i>Facebook login</a>
				<?php }else{?>
					<a href="<?=base_url()?>auth/logout" class="waves-effect waves-light btn indigo darken-3"><i class="fa fa-facebook left"></i>Facebook logout</a>
				<?php }
				?>
				
			</div>
		</div>
		<div class="row">	

			<?php foreach ($users as $row) {?>
				<div class="col s12 m6 l4">
					<div class="card ">
			            <div class="card-image">
			              <img src="<?=$row['profile_pic']?>">
			              <span class="card-title"><?=$row['name']?></span>
			            </div>
			            <div class="card-action">
			              <a href="#"><?=$row['name']?></a>
			            </div>
			        </div>
				</div>
			<?php }?>
		</div>
	</div>

</body>
</html>