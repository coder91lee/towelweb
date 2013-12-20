<div id="category">
	<div class="app-container">
		<div class="app-wrapper">
			<div class="container">
				<div class="cat-list-apps">
					<div class="bx-content">
						<?php if(isset($list) && $list):?>
							<?php foreach ($list as $app):?>
    							<div class="app-detail pull-left">
									<div class="wrapper">
										<div class="thumb pull-left">
											<a href="<?php echo $app['href'];?>">
												<img width="84px" 
													 src="<?php
                                                              $image_small = HTTP_IMAGE_APP_SMALL."/100/".$app['image_small'];
                                                              $file_headers = @get_headers($image_small);
                                                              if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
                                                                  $image_small = HTTP_IMAGE_APP_SMALL . $app['image_small'];
                                                              }
                                                                  
                                                	          echo  $image_small;?>" alt="">
												<span class="mask"></span>
											</a>
										</div>
										<div class="infos-app pull-left">
											<a href="<?php echo $app['href'];?>">
												<h3 class="name-app"><?php echo $app['app_name'];?></h3>
											</a>
											<div class="cat-name">
												<?php echo $app['category_name'];?>
											</div>
											<div class="stars">
												<span class="gray-star"></span>
												<span class="gray-star"></span>
												<span class="gray-star"></span>
												<span class="gray-star"></span>
												<span class="gray-star"></span>
											</div>
											<div class="view">
												<?php echo $app['count_view'];?>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach;?>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>