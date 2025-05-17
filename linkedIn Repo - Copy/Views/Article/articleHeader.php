<section>
    <div class="feature-photo">
        <figure><img src="../../Assets/images/resources/timeline-1.jpg" alt=""></figure>
        
        <div class="add-btn">
            <span>1205 followers</span>
            <a href="#" title="" data-ripple="">Add Friend</a>
        </div>
        <form class="edit-phto">
            <i class="fa fa-camera-retro"></i>
            <label class="fileContainer">
                Edit Cover Photo
                <input type="file"/>
            </label>
        </form>
        <div class="container-fluid">
            <div class="row merged">
                <div class="col-lg-2 col-sm-3">
                    <div class="user-avatar">
                        <figure>
                            <img src="<?php echo $user->getProfilePhoto()?>" alt="">
                            <form class="edit-phto">
                                <i class="fa fa-camera-retro"></i>
                                <label class="fileContainer">
                                    Edit Display Photo
                                    <input type="file"/>
                                </label>
                            </form>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-10 col-sm-9">
                    <div class="timeline-info">
                        <ul>
                            <li class="admin-name">
                                <h5><?php echo $user->getName()?></h5>
                            </li>
                            <li>
                                <a class="active" href="../Timeline/timeline.php" title="" data-ripple="">time line</a>

								<a class="" href="../Timeline/timeline-friends.php" title="" data-ripple="">Connections</a>
								<a class="" href="../Group/leaveGroup.php" title="" data-ripple="">Groups</a>
                                <a class="" href="Article.php" title="" data-ripple="">Articles</a>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- top area --> 