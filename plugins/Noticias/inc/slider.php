
	<?php 
		$all = array();
		if (!empty($destacado)) {
			foreach ($destacado as $key => $value) {
				$all[] = $value;
			}
		}
		if (!empty($normal)) {
			foreach ($normal as $key => $value) {
				$all[] = $value;
			}
		}
		$count = count($all);
		$format_data = array();

	
		foreach($all as $k => $v):
			$format_data[$k]["title"] = $v->title;
			$format_data[$k]["id"] = $v->id;
			$format_data[$k]["date"] = $v->pdate;
			preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', apply_filters("the_content", $v->content ), $matches);
			$format_data[$k]["content"] = strip_tags(apply_filters("the_content", $v->content ));
			$format_data[$k]["img"] = preg_replace('/-[0-9]+x+[0-9]+/i', '',$matches[1][0]);
		endforeach;

	 ?>


<div class="banner">
 	<div class="cont-center">
		<div class="ss1_wrapper">
			<div class="ss1_entry">
				<div class="slider-arrows">
					<a href="#" class="slideshow_prev">
						<div class="color-transparent"></div>
						<span class="wsp-icon-arrow-left"></span>
					</a>
					<a href="#" class="slideshow_next">
						<div class="color-transparent"></div>
						<span class="wsp-icon-uniE604"></span>
					</a>
				</div>
				<div class="slideshow_paging">
					
				</div>
				<div class="slideshow_wrapper">
					<div class="slideshow_box">
						<div class="data">
							<div class="color-transparent"></div>
							<h4 class="title-display ">
								<a href="http://www.deragopyan.com/slider3/"></a>
							</h4>
							<div class="description-display ">
								<p></p>
							</div>
						</div>
					</div>
				</div>
				<div id="slideshow_1" class="slideshow">

					<?php
						if($count > 0):
							foreach ($format_data as $key => $val): ?>
							<div class="slideshow_item" >
								<div class="degrade-left"></div>
								<div class="degrade-right"></div>
								<img src="<?php echo($val["img"]) ?>">
								<div class="data">
									<h4 class="title-display ">
										<a href="#"><?php echo($val["title"])?></a>
									</h4>
									<div class="description-display ">
										<p><?php echo($val["content"]) ?></p>
									</div>
								</div>
							</div>
					<?php endforeach;
					endif; ?>
				</div>
			</div>
		</div>
	</div>
 </div> 