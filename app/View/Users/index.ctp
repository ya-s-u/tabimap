<div class="map">
	<div class="container">
		<div id="DefaultHead" class="map_user">
			<img class="map_user_thumb" src="<?=$this->Twitter->resizeThumb($user['User']['twitter_image_url'])?>" width="90" height="80">
			<p id="MapTitle" class="map_user_main"><?=$user['User']['username']?>さんが訪れた国</p>
			<ul class="map_user_sub">
				<li class="tw"><a target="_blank" href="https://twitter.com/<?=$user['User']['twitter_screen_name']?>"><i class="icon icon-twitter"></i><?=$user['User']['twitter_screen_name']?></a></li>
				<li class="modified"><i class="icon icon-clock"></i><?=date("Y/n/j" , strtotime($user['User']['modified']))?></li>
				<li><i class="icon icon-earth"></i><?=$num?>カ国(<?=ceil($num/195*100)?>%)</li>
			</ul>
		</div>
		<div id="EditHead" class="map_edit" style="display:none">
			<p class="map_edit_title">訪れたことのある国を選択して下さい</p>
			<ul class="map_edit_mode">
				<li id="MapMode" class="active">地図から選ぶ</li>
				<li id="FlagMode">国旗から選ぶ</li>
			</ul>
			<p class="map_edit_sum"><i id="EditSum"><?=$num?></i>カ国</p>
		</div>
		<div id="FlagSelect" class="flag_select" style="display:none">
		    <ul class="flag_select_list">
				<?php
				foreach($Country as $code => $country) {
					if($user['User'][$code] == 1) {
						echo '<li name="'.$code.'" class="active"><i class="flag49 flag49_'.$code.'"></i>'.$country.'</li>';
					} else {
						echo '<li name="'.$code.'"><i class="flag49 flag49_'.$code.'"></i>'.$country.'</li>';
					}
				}
				?>
			</ul>
		</div>
		<button id="Share" class="b_map_share" data-remodal-target="shareMap"><i class="icon-twitter"></i>マップをシェア</button>
		<button id="Edit" class="b_map_edit"><i class="icon-plus"></i>国を編集する</button>
		<button id="Cancel" class="b_map_cancel" style="display:none"><i class="icon-cross"></i>キャンセル</button>
		<button id="Submit" class="b_map_submit" style="display:none"><i class="icon-checkmark"></i>変更する</button>
	</div>
	<div id="Map">
		<div id="svg_map" style="width: 1200px; height: 700px;"></div>
	</div>
</div>
<div class="view container">
	<div class="view_left">
		<div class="visited">
			<p class="visited_title"><i class="icon-star"></i>あなたが訪れたことのある国</p>
			<ul class="visited_list_flags">
				<?php
					foreach($Flags as $code => $country) {
						echo '<li><i class="flag70 flag70_'.$code.'"></i>'.$country.'</li>';
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
<div class="container">
	<p class="user_delete"><a href="/users/delete">退会する</a></p>
	<p class="user_logout"><a href="/users/logout">ログアウト</a></p>
</div>
<?=$this->element('share')?>
<?php
	echo $this->Form->create('User',array('class'=>''));
	foreach($Country as $key => $value) {
		if($user['User'][$key] == 1) {
			echo $this->Form->hidden($key, array('value'=>1));
		} else {
			echo $this->Form->hidden($key, array('value'=>0));
		}
	};
	echo $this->Form->end();
?>
<script type="text/javascript">
	const currentSet = [];
	<?php
		foreach($Flags as $code => $country) {
			echo 'currentSet.push("'.$code.'");';
		}
	?>
</script>