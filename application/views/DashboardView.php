<p class="clear"></p>
<div id="banner" class="txtalign-c">

    <img src="<?php print base_url().'assest/images/contractor-careers-big-title.png'?>" alt="Contractor Careers" />
</div>
<div id="main" class="cf">
    <div class="col-l col-wide">
        <div id="findteacherjobs">
            <h2 class="tg-title"><?= FIND_CONTRACTOR_JOBS;?></h2>

            <!-- Sector start -->
            <?php
					$sectors = getMainSectorNames();
			?>
            <?php if(count($sectors)>0):
					  $count = 1;?>
                      <ul id="arealist" class="hor">
                      <?php foreach ($sectors as $key=>$value):
            		  $count++;?>
                      <li>
                        <a onclick="to_push('CountryButton')" href="<?=site_url('Jobpost_Control/listJobPosts/'.$key);?>" title="Transport">
                            <?=$value;?>
                        </a>
                    </li>
                    <?php endforeach;?>
                    </ul>
                    <?php endif;?>
            <a onclick="to_push('ViewAllJobsLink')" href="<?=site_url("Jobpost_Control/listJobPosts/");?>" class="arrowlink-r mt-20">View all jobs</a>
            <a href="" class="arrowlink-r mt-20 ml-20">View jobs on map</a>
        </div>

        <div class="mt-50">
            <h2 class="tg-title">search job database</h2>
            <form action="http://www.teachergig.com/search" method="post" id="search_frm">
			  <!--start test-->
				<div class="cf mt-20 col-l input-l">
                    <label for="ac-field" class="col-l tg-label bold">Sector</label>
                    <input name="keywords" maxlength="40" size="40" type="text" class="tg-input ml-10" value="" />
					<p class="clear"></p>
                    <p class="gra mt-8 clear ml-75">Ex: "transpoort" or "Cleaning" or "Building & Reservation"</p>
                </div>
                <div class="cf mt-20 col-l input-m">
                    <label for="first_name" class="col-l tg-label bold">Cities</label>
                    <input type="text" id="first_name" name="first_name" class="tg-input ml-10 col-l " value=""  />
                    <p class="clear"></p>
                    <p class="gra mt-8 ml-75">Example: "Bruges"</p>
                </div>
                <div class="cf mt-20 col-l input-m ml-25">
                    <label for="last_name" class="col-l tg-label bold">Zip code:</label>
                    <input type="text" id="last_name" name="last_name" class="tg-input ml-18 col-l " value="" />
                    <p class="clear"></p>
                    <p class="gra mt-8 ml-75">Example: "#####"</p>
                </div>
				  <div class="cf mt-20 col-l input-m ml-25">
                    <label for="last_name" class="col-l tg-label bold">Radius:</label>
                    <input type="text" id="last_name" name="last_name" class="tg-input ml-18 col-l " value="" />
                    <p class="clear"></p>
                    <p class="gra mt-8 ml-75">Example: "5 KM"</p>
                </div>
                <p class="clear"></p>


			  <!--End test -->



                <p class="txt-xl dark mt-8 ">

                    <input type="submit" onclick="to_push('SearchButton')" value="Search" class="tg-submit col-r" />
                    <input type="hidden" name="action" value="search" />


                   <!-- <input name="keywords" maxlength="40" size="40" type="text" class="tg-input keywords" value="" />
                    <input type="submit" onclick="to_push('SearchButton')" value="Search" class="tg-submit col-r" />
                    <input type="hidden" name="action" value="search" />
                    <p class="gra mt-8 clear">Ex: "transpoort" or "Cleaning" or "Building & Reservation"</p>
					-->
                </p>
            </form>

        </div>


        <div class="mt-50">
            <h2 class="tg-title">job notifier</h2>
            <p class="txt-xl dark">We can send you an email as soon as new teaching jobs are posted in a country of your choosing. You can set the notifier to do this for as long as you want.</p>
            <a href="jobnotifier.html" class="arrowlink-r mt-30">Set up notifier</a>
        </div>
    </div>
    <div class="col-r col-narrow">
        <div id="featuredteacherjobs">
            <h2 class="tg-title"><?=FEATURED_CONTRACTOR_JOBS_TITLE;?></h2>
            <ul>
            <?php
            	if(count($featuredJobs)>0):
            		foreach ($featuredJobs as $key=>$job):
            ?>
               <li>
                        <div class="ellipsis"><a onclick="to_push('FeaturedJobLink')" href="" class="tj-title"><?=$job['title']; ?></a></div>
                                                <span class="tj-icon-new ml-3"></span>
                                                <div class="clr"></div>
                        <p class="dark mt-3"><?=$job['contractorName']?></p>
                        <p class="mt-3">
                            <a href="" title="See more jobs from Singapore on a map" class="tj-loc"><?=$job['address']?></a>

                            <span class="tj-date ml-15"><?= getDateDiffDays($job['created']);?></span>
                        </p>
                    </li>
            </ul>
            <?php
                endforeach;
                endif;
            ?>
        </div>
    </div>

        <script>
            jQuery(function($) {
                $(".ellipsis").ellipsis();
            });
        </script>


