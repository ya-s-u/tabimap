<div class="map">
	<div class="container">
		<div class="map_friend">
			<p class="map_friend_main">みんなが訪れた<?=h($country_sum)?>カ国</p>
			<p class="map_friend_sub"><?=h($user['User']['username'])?>さんと<?=h($friend_sum)?>人の友達</p>
		</div>
		<ul class="map_define">
			<li><i class="map_define_me"></i>あなた</li>
			<li><i class="map_define_others"></i>友達</li>
		</ul>
		<button class="b_map_share" data-remodal-target="shareMap"><i class="icon-twitter"></i>マップをシェア</button>
	</div>
	<div id="svg_map" style="width:<?=$this->Style->MapWidth($is_mobile)?>px; height:<?=$this->Style->MapHeight($is_mobile)?>px;"></div>
</div>
<div class="friends container">
	<h2 class="friends_title"><i class="icon-star"></i>すべての友達(<?=count($Friends)?>)<span>twitterでフォローしている人(現在テスト中につき全てのユーザーが表示されます)</span></h2>
	<ul class="friends_list">
		<?php foreach($Friends as $friend) :?>
		<li>
			<a href="/users/view/<?=h($friend['User']['twitter_screen_name'])?>">
				<img class="friends_list_thumb" src="<?=$this->Twitter->resizeThumb($friend['User']['twitter_image_url'])?>">
				<h3 class="friends_list_name"><?=h($friend['User']['username'])?></h3>
				<ul class="friends_list_detail">
					<li class="friends_list_detail_twitter"><i class="icon-twitter"></i><?=h($friend['User']['twitter_screen_name'])?></li>
					<li class="friends_list_detail_modified"><i class="icon-clock"></i><?=date("Y/n/j" , strtotime($friend['User']['modified']))?></li>
				</ul>
				<ul class="friends_list_flags">
					<?php
						$m = 0;
						foreach($Country as $code => $country) {
							if($friend['User'][$code] == 1) {
								$m++;
								if($m <= 10) {
									echo '<li><i class="flag49 flag49_'.$code.'"></i></li>';
								}
							}
						}
					?>
				</ul>
				<?php if($m > 10) echo '<p class="friends_list_more">上記以外に'.($m-10).'カ国</p>'?>
			</a>
		</li>
		<?php endforeach?>
	</ul>
	<?php
	if($is_mobile) {
		echo '<ins class="adsbygoogle ads_mobile" style="display:inline-block;width:320px;height:50px" data-ad-client="ca-pub-7183337843978214" data-ad-slot="7822193482"></ins>';
	} else {
		echo '<ins class="adsbygoogle ads_big" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-7183337843978214" data-ad-slot="4868727089"></ins>';
	}
	?>
</div>
<?=$this->element('share')?>
<script type="text/javascript">
	var arrOthers = [];
	<?php
		foreach($FlagsOthers as $code => $country) {
			echo 'arrOthers.push("'.$code.'");';
		}
	?>
	var arrMe = [];
	<?php
		foreach($FlagsMe as $code => $country) {
			echo 'arrMe.push("'.$code.'");';
		}
	?>
	var currentSet = [];
</script>