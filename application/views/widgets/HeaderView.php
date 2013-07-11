    <link type="text/css" rel="stylesheet" href=<?php print base_url()."assest/css/base.css"?> media="all" />
    <link type="text/css" rel="stylesheet" href=<?php print base_url()."assest/css/common.css"?> media="all" />
    <link type="text/css" rel="stylesheet" href=<?php print base_url()."assest/css/form.css"?> media="all" />
    <link type="text/css" rel="stylesheet" href=<?php print base_url()."assest/css/home.css"?> media="all" />
    <link type="text/css" rel="stylesheet" href=<?php print base_url()."assest/css/jobs.css"?> media="all" />
    <link type="text/css" rel="stylesheet" href=<?php print base_url()."assest/css/employers.css"?> media="all" />
    <link type="text/css" rel="stylesheet" href=<?php print base_url()."assest/css/search.css"?> media="all" />

<div id="header" class="col-l">
                <a href="<?=site_url('dashboard_control')?>">
                    <img src="<?php print base_url().'assest/images/logo.png'?>" alt="job board" />
                </a>
            </div><ul id="nav" class="hor col-r">
    <li class="first active">
        <a onclick="to_push('HomeButton');" href="<?=site_url('dashboard_control')?>">Home</a>
    </li>
    <li>
        <a onclick="to_push('LatestJobsButton');" href="<?=site_url('Jobpost_Control/listJobPosts')?>">Latest jobs</a>
    </li>
    <li >
        <a onclick="to_push('AddYourCVButton');" href="<?=site_url('Subcontractor_Control')?>">Add your CV</a>
    </li>
    <li >
        <a onclick="to_push('NotifierButton');" href="<?=site_url('Notifyjob_Control')?>">Job notifier</a>
    </li>
    <li >
        <a onclick="to_push('ForEmployersButton')" href="<?=site_url('Jobpost_Control')?>">For employers</a>
    </li>
</ul>
