<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Plantation</title>
<meta http-equiv="imagetoolbar" content="no" />

<meta name="description" content="birthday" />

<link href="<?php print base_url()."assest/css/bootstrap.min.css"?>" rel="stylesheet" />
<link href="<?php print base_url()."assest/css/bootstrap-responsive.min.css"?> rel="stylesheet" />

<script type="text/javascript" src="<?php print base_url()."assest/js/bootstrap.min.js"?>"></script>
<script src="<?php print base_url()."assest/js/jquery.js"?>"></script>
</head>
<body>

	<?php echo form_open_multipart('dashboard_control/pay');?>
	    <div id="wrapper" class="pw align-c">
			<label>Username</label>
			<input name="username"/>
	    </div>
	     <div id="wrapper" class="pw align-c">
			<input name="request" type="submit" value="pay" class="btn btn-success"/>
	     </div>
	<?php echo form_close();?>
 <script>
 </script>
</body>
</html>
