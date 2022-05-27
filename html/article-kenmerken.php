<?php if($data['article-kenmerken-show-features-module']->rawvalue == 0) { ?>
		<section class="features-block">
			<div class="container">
					<?php if(!empty($data['article-kenmerken-title']->rawvalue)) { ?>
					<h2><?php echo $data['article-kenmerken-title']->rawvalue;?></h2>
					<?php } ?>
					<?php if(!empty($data['article-kenmerken-introtext']->rawvalue)) { ?>
					<div class="intro"><?php echo $data['article-kenmerken-introtext']->rawvalue; ?></div>
					<?php } ?>
					<div class="row">
					<?php if(!empty($data['article-kenmerken-list-title1']->rawvalue)) { ?>
						<div class="col6">
							<h4><?php echo $data['article-kenmerken-list-title1']->rawvalue; ?></h4>
							<?php $list1 = json_decode($data['article-kenmerken-list-item1']->rawvalue); ?>
							<ul>
							<?php
							foreach($list1 as $list1_single) {
								echo '<li class="specification">'.$list1_single->field10.'</li>';
							}
							?>
							</ul>
						</div>
					<?php } ?>
					
					<?php if(!empty($data['article-kenmerken-list-title2']->rawvalue)) { ?>
						<div class="col6">
							<h4><?php echo $data['article-kenmerken-list-title2']->rawvalue; ?></h4>
							<?php $list2 = json_decode($data['article-kenmerken-list-item2']->rawvalue); ?>
							<ul>
							<?php
							foreach($list2 as $list2_single) {
								echo '<li class="specification">'.$list2_single->field10.'</li>';
							}
							?>
							</ul>
						</div>
					<?php } ?>
					
					<?php if(!empty($data['article-kenmerken-list-title3']->rawvalue)) { ?>
						<div class="col6">
							<h4><?php echo $data['article-kenmerken-list-title3']->rawvalue; ?></h4>
							<?php $list3 = json_decode($data['article-kenmerken-list-item3']->rawvalue); ?>
							<ul>
							<?php
							foreach($list3 as $list3_single) {
								echo '<li class="specification">'.$list3_single->field10.'</li>';
							}
							?>
							</ul>
						</div>
					<?php } ?>
					
					<?php if(!empty($data['article-kenmerken-list-title4']->rawvalue)) { ?>
						<div class="col6">
							<h4><?php echo $data['article-kenmerken-list-title4']->rawvalue; ?></h4>
							<?php $list4 = json_decode($data['article-kenmerken-list-item4']->rawvalue); ?>
							<ul>
							<?php
							foreach($list4 as $list4_single) {
								echo '<li class="specification">'.$list4_single->field10.'</li>';
							}
							?>
							</ul>
						</div>
					<?php } ?>
					
					<?php if(!empty($data['article-kenmerken-list-title5']->rawvalue)) { ?>
						<div class="col6">
							<h4><?php echo $data['article-kenmerken-list-title5']->rawvalue; ?></h4>
							<?php $list5 = json_decode($data['article-kenmerken-list-item5']->rawvalue); ?>
							<ul>
							<?php
							foreach($list5 as $list5_single) {
								echo '<li class="specification">'.$list5_single->field10.'</li>';
							}
							?>
							</ul>
						</div>
					<?php } ?>
					
					<?php if(!empty($data['article-kenmerken-list-title6']->rawvalue)) { ?>
						<div class="col6">
							<h4><?php echo $data['article-kenmerken-list-title6']->rawvalue; ?></h4>
							<?php $list6 = json_decode($data['article-kenmerken-list-item6']->rawvalue); ?>
							<ul>
							<?php
							foreach($list6 as $list6_single) {
								echo '<li class="specification">'.$list6_single->field10.'</li>';
							}
							?>
							</ul>
						</div>
					<?php } ?>
					</div>
				
			</div>
		</section>
<?php } else { ?>
	<?php echo JHtml::_('content.prepare', '{loadposition feature-list}'); ?>
<?php } ?>