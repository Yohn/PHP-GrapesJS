<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<!-- Add icons to the links using the .nav-icon class
			 with font-awesome or any other icon font library -->
		<?php if ($level->levels() === 5 || $level->levels() === 9) {
			?>
			<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-tachometer-alt"></i>
					<p>
						Dashboard
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/index.php" class="nav-link <?php
						if ($fname === 'dashboard') {
							echo 'active';
						}
						?>">
							<i class="far fa-circle nav-icon"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=siteconf" class="nav-link <?php
						if ($cms === 'siteconf') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-cogs"></i>
							<p>
								Site Definitions
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=themes&w=list" class="nav-link <?php
						if ($cms === 'themes') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-solid fa-draw-polygon"></i>
							<p>
								Themes
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=theme_template" class="nav-link <?php
						if ($cms === 'theme_tenplate') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-solid fa-draw-polygon"></i>
							<p>
								Theme template
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=menu" class="nav-link <?php
						if ($cms === 'menu') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-bars"></i>
							<p>
								Menu template
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=plugins" class="nav-link <?php
						if ($cms === 'plugins') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-th-large"></i>
							<p>
								Plugins App
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=volunteer" class="nav-link <?php
						if ($cms === 'volunteer') {
							echo 'active';
						}
						?>">
							<i class="fas fa-table nav-icon"></i>
							<p>Volunteer</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=users" class="nav-link <?php
						if ($cms === 'users') {
							echo 'active';
						}
						?>">
							<i class="fas fa-users nav-icon"></i>
							<p>Users</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=adduser" class="nav-link <?php
						if ($cms === 'adduser') {
							echo 'active';
						}
						?>">
							<i class="fas fa-users nav-icon"></i>
							<p>Add User</p>
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="fas fa-solid fa-file nav-icon"></i>
					<p>
						Pages
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=list_pages" class="nav-link <?php
						if ($cms === 'list_pages') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-list-alt"></i>
							<p>
								Page list
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=add_page" class="nav-link <?php
						if ($cms === 'add_page') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-file-alt"></i>
							<p>
								Add page
							</p>
						</a>
					</li>
					<li class="nav-item has-treeview">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-book"></i>
							<p>
								View Pages
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<?php
							$pages = $conn->query("SELECT * FROM page");
							while ($page = $pages->fetch_array()) {
								$plink = $page['link'];
								$ptitle = $page['title'];
								$pparent = $page['parent'];
								echo'<li class="nav-item">';
								if ($pparent > 0) {
									$parent = $conn->query("SELECT * FROM page where id=$pparent");
									$pagep = $parent->fetch_assoc();
									echo '<a href="' . SITE_PATH . $pagep['link'] . '/' . $plink . '" target="_blank" class="nav-link ';
								} else {
									echo '<a href="' . SITE_PATH . $plink . '" target="_blank" class="nav-link ';
								}

								if ($fname === $plink) {
									echo 'active';
								}
								echo '">';
								echo '<p>' . $ptitle . '</p>';
								echo '<i class="far fa-circle nav-icon"></i>';
								echo '</a>';
								echo '</li>';
							}
							?>
						</ul>
					</li>
				</ul>
			</li>
			<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="fas fa-solid fa-paste nav-icon"></i>
					<p>
						Posts
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=post_category&w=list" class="nav-link <?php
						if ($cms === 'post_category') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-list-ul"></i>
							<p>
								Post Category
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=list_posts" class="nav-link <?php
						if ($cms === 'list_posts') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-list-alt"></i>
							<p>
								List Posts
							</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=add_post" class="nav-link <?php
						if ($cms === 'add_post') {
							echo 'active';
						}
						?>">
							<i class="nav-icon fas fa-file-alt"></i>
							<p>
								Add post
							</p>
						</a>
					</li>
					<li class="nav-item has-treeview">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-book"></i>
							<p>
								View Posts
								<i class="fas fa-angle-left right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<?php
							$posts = $conn->query("SELECT * FROM blog_posts");
							while ($post = $posts->fetch_array()) {
								$plink = $post['link'];
								$ptitle = $post['title'];
								$category = $poste['category_id'];
								echo'<li class="nav-item">';
								if ($category > 0) {
									$categ = $conn->query("SELECT * FROM blog_posts LEFT JOIN categories ON categoryID=category_id where category_id=$category");
									$pcatg = $categ->fetch_assoc();
									echo '<a href="' . SITE_PATH . $pcatg['link'] . '/' . $plink . '" target="_blank" class="nav-link ';
								} else {
									echo '<a href="' . SITE_PATH . $plink . '" target="_blank" class="nav-link ';
								}

								if ($fname === $plink) {
									echo 'active';
								}
								echo '">';
								echo '<i class="far fa-circle nav-icon"></i>';
								echo '<p>' . $ptitle . '</p>';
								echo '</a>';
								echo'</li>';
							}
							?>
						</ul>
					</li>
				</ul>
			</li>
			<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="fas fa-solid fa-server nav-icon"></i>
					<p>
						CRUD System
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=table_config" class="nav-link <?php
						if ($cms === 'table_config') {
							echo 'active';
						}
						?>">
							<i class="fas fa-solid fa-table nav-icon"></i>
							<p>Table Config</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=table_manager&w=list" class="nav-link <?php
						if ($cms === 'table_manager') {
							echo 'active';
						}
						?>"><i class="fas fa-solid fa-database nav-icon"></i>
							<p>Table Manager</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=column_manager&w=select" class="nav-link <?php
						if ($cms === 'column_manager') {
							echo 'active';
						}
						?>">
							<i class="fas fa-calendar-check nav-icon"></i>
							<p>Column Manager</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo SITE_PATH; ?>admin/dashboard.php?cms=table_crud&w=select" class="nav-link <?php
						if ($cms === 'table_crud') {
							echo 'active';
						}
						?>">
							<i class="fas fa-solid fa-server nav-icon"></i>
							<p>Table CRUD</p>
						</a>
					</li>
				</ul>
			</li>
		<?php } ?>
		<li class="nav-item has-treeview">
			<a href="#" class="nav-link">
				<i class="nav-icon fas fa-user-shield"></i>
				<p>
					Personal info
					<i class="right fas fa-angle-left"></i>
				</p>
			</a>
			<ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="<?php echo SITE_PATH; ?>users/profile.php?user=pinfo" class="nav-link <?php
					if ($user === 'pinfo') {
						echo 'active';
					}
					?>">
						<i class="fas fa-id-card nav-icon"></i>
						<p>Personal Info</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo SITE_PATH; ?>users/profile.php?user=pdetail" class="nav-link <?php
					if ($user === 'pdetail') {
						echo 'active';
					}
					?>">
						<i class="fas fa-id-card nav-icon"></i>
						<p>Personal details</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo SITE_PATH; ?>users/profile.php?user=sphra" class="nav-link <?php
					if ($user === 'sphra') {
						echo 'active';
					}
					?>">
						<i class="fas fa-user-lock nav-icon"></i>
						<p>Secure Phrase</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo SITE_PATH; ?>users/profile.php?user=chpass" class="nav-link <?php
					if ($user === 'chpass') {
						echo 'active';
					}
					?>">
						<i class="fas fa-key nav-icon"></i>
						<p>Change password</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo SITE_PATH; ?>users/profile.php?user=chpin" class="nav-link <?php
					if ($user === 'chpin') {
						echo 'active';
					}
					?>">
						<i class="nav-icon fas fa-file-alt"></i>
						<p>
							Change PIN
						</p>
					</a>
				</li>
			</ul>
		</li>


	</ul>
</nav>
