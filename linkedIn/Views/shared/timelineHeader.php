
<section>
	<div class="feature-photo">
		<figure><img src="<?php echo $user->coverPhoto ?>" alt=""></figure>
		
		<div class="add-btn">
			<span><?php echo $user->connectionCount; ?> Connections  </span>
			<a href="#" title="" data-ripple="">Connect</a>
		</div>
		<form class="edit-phto">
			<i class="fa fa-camera-retro"></i>
			<label class="fileContainer">
				Edit Cover Photo
				<input type="file" />
			</label>
		</form>
		<div class="container-fluid">
			<div class="row merged">
				<div class="col-lg-2 col-sm-3">
					<div class="user-avatar">
						<figure>
							<img src="<?php echo $user->profilePhoto ?>" alt="">
							<form method="post" action="../profile/upload.php" enctype="multipart/form-data">
								<i class="fa fa-camera-retro"></i>
								<label class="fileContainer">
									Edit Profile Photo
									<input  type="file" name="profile_photo">
									
								</label>
								<!-- <button type="submit">submit</button> -->
							</form>
						</figure>
					</div>
				</div>
				<div class="col-lg-10 col-sm-9">
					<div class="timeline-info">
						<ul>
							<li class="admin-name">
								<h5><?php echo $user->name ?></h5>
							</li>
							<li>
								<a class="active" href="../Timeline/timeline.php" title="" data-ripple="">time line</a>

								<a class="" href="" title="" data-ripple="">Connections</a>
								<a class="" href="../Group/leaveGroup.php" title="" data-ripple="">Groups</a>
								<a class="" href="" title="" data-ripple="">Articles</a>
<!-- 
								<a class="" href="about.html" title="" data-ripple="">about</a> -->
								<!-- <a class="" href="#" title="" data-ripple="">more</a> -->
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- top area -->