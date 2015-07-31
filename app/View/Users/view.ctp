<div class="map">
	<div class="container">
		<div class="map_user">
			<img class="map_user_thumb" src="<?=$this->Twitter->resizeThumb($user['User']['twitter_image_url'])?>" width="90" height="80">
			<p id="MapTitle" class="map_user_main"><?=$user['User']['username']?>さんが訪れた国</p>
			<ul class="map_user_sub">
				<li class="tw"><a target="_blank" href="https://twitter.com/<?=$user['User']['twitter_screen_name']?>"><i class="icon icon-twitter"></i><?=$user['User']['twitter_screen_name']?></a></li>
				<li class="modified"><i class="icon icon-clock"></i><?=date("Y/n/j" , strtotime($user['User']['modified']))?></li>
				<li><i class="icon icon-earth"></i><?=$num?>カ国(<?=ceil($num/195*100)?>%)</li>
			</ul>
		</div>
	</div>
	<div id="svg_map" style="width: 1200px; height: 700px;"></div>
</div>
<div class="view container">
	<div class="view_left">
		<div class="visited">
			<p class="visited_title"><i class="icon-star"></i>あなたも訪れたことのある国</p>
			<ul class="visited_list_flags">
				<?php
					foreach($MeFlags as $code => $country) {
						echo '<li><i class="flag70 flag70_'.$code.'"></i>'.$country.'</li>';
					}
					if($MeFlags == null) {
						echo '<p class="visited_list_flags_none">まだありません</p>';
					}
				?>
			</ul>
		</div>
		<div class="visited">
			<p class="visited_title"><i class="icon-star"></i>あなたがまだ訪れたことのない国</p>
			<ul class="visited_list_flags">
				<?php
					foreach($OthersFlags as $code => $country) {
						echo '<li><i class="flag70 flag70_'.$code.'"></i>'.$country.'</li>';
					}
					if($OthersFlags == null) {
						echo '<p class="visited_list_flags_none">まだありません</p>';
					}
				?>
			</ul>
		</div>
	</div>
	<?php
	if($is_mobile) {
		echo '<ins class="adsbygoogle ads_mobile" style="display:inline-block;width:320px;height:50px" data-ad-client="ca-pub-7183337843978214" data-ad-slot="7822193482"></ins>';
	} else {
		echo '<ins class="adsbygoogle ads_rectangle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-7183337843978214" data-ad-slot="9298926685"></ins>';
	}
	?>
</div>
<script type="text/javascript">
	var arr = [];
	<?php
	foreach($MeFlags as $code => $country) {
		echo 'arr.push("'.$code.'");';
	}
	foreach($OthersFlags as $code => $country) {
		echo 'arr.push("'.$code.'");';
	}
	?>
	var currentSet = [];
</script>