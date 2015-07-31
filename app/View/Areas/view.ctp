<div class="area">
	<div class="container">
		<ul class="area_menu">
			<?php
				foreach($Area as $code => $data) {
					echo '<li id="'.$code.'" ';
					if($code==$title_for_layout) echo 'class="active"';
					echo '><a href="/areas/view/'.$code.'">'.$data.'</a></li>';
				}
			?>
		</ul>
	</div>
</div>
<div class="area_main container">
	<div class="area_left">
		<h2 class="area_title"><?=$title_for_layout?></h2>
		<ul class="area_list">
			<?php foreach($Country as $code => $country) :?>
			<?php if($code == 'JP') continue?>
			<li>
				<i class="flag28 flag28_<?=$code?>"></i>
				<p class="area_list_title"><?=$country['ja']?></p>
				<?php if($country['users'] != null):?>
				<div class="area_list_users">
					<?php
						$temp = 0;
						foreach($country['users'] as $user) {
							echo '<a href="/users/view/'.h($user['twitter_screen_name']).'"><img class="area_list_users_thumb" src="'.h($user['twitter_image_url']).'"></a>';
						}
					?>
				</div>
				<?php endif?>
			</li>
			<?php endforeach?>
		</ul>
	</div>
	<?php
	if($is_mobile) {
		echo '<ins class="adsbygoogle ads_mobile" style="display:inline-block;width:320px;height:50px" data-ad-client="ca-pub-7183337843978214" data-ad-slot="7822193482"></ins>';
	} else {
		echo '<ins class="adsbygoogle ads_large" style="display:inline-block;width:300px;height:600px" data-ad-client="ca-pub-7183337843978214" data-ad-slot="3252393084"></ins>';
	}
	?>
</div>