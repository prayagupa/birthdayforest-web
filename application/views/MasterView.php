<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Contractors job board</title>
    <meta http-equiv="imagetoolbar" content="no" />

    <meta name="description" content="Contrators job board" />
    <meta name="keywords" content="Contrators jobs - no signup, no ads - just new jobs." />

<script src="<?php print base_url()."assest/js/jquery.js"?>"></script>
</head>
<body>
    <div id="wrapper" class="pw align-c">
        <div id="container">
        <?php
		if($header==2)
			include_once 'widgets/PostJobHeaderView.php';
		else
			include_once 'widgets/HeaderView.php';
		?>
		<!-- header end -->
        <?php
			if(isset($mainContent))
				$this->load->view($mainContent);
		?>
    </div>
   </div>
<?php include_once 'widgets/FooterView.php';?>

 <script>
            function to_push(action){
                        push(['_trackEvent', 'FrontPageActivity', 'Click', action]);
            }
            function push(param){
                            _gaq.push(param);
            }
            var baseUrl = 'http://www.teachergig.com/';
        </script>
</body>
</html>