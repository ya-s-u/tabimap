<div class="create_head">
	<div class="create_head_overlay">
		<div class="container">
			<h1 class="header_title"><a href="/"><i class="icon-logo"></i><span>βver</span></a></h1>
			<button class="b_create_head_login"><a href="/twitters/redirect1"><span class="icon-twitter"></span>ログイン</a></button>
			</ul>
			<h2 class="create_head_title">行った国を友達とシェア<br />しよう</h2>
			<p class="create_head_sub">行ったことのある国をクリックするだけ、簡単登録</p>
			<?=$this->Html->image('map.png',array('class' => 'create_head_map'))?>
			<button id="CreateButton" class="b_create_head_create" data-remodal-target="createMap"><i class="icon-earth"></i>自分の地図を作る</button>
		</div>
	</div>
</div>
<div class="container">
	<p class="create_main_title">Tabimapで出来る事</p>
	<ul class="create_main_list">
		<li>
			<?=$this->Html->image('map.png')?>
			<h3><i class="icon-compass"></i>行った国に色を塗ってSNSでシェア</h3>
			<p>んがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがふがーーーーーーー</p>
		</li>
		<li>
			<?=$this->Html->image('map.png')?>
			<h3><i class="icon-compass"></i>友達の行った国を地図で一覧表示</h3>
			<p>んがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがふがーーーーーーー</p>
		</li>
		<li>
			<?=$this->Html->image('map.png')?>
			<h3><i class="icon-compass"></i>同年代の人から人気の国が分かる</h3>
			<p>んがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがふがーーーーーーー</p>
		</li>
	</ul>
	<p class="create_main_title">今後提供予定の機能</p>
	<ul class="create_main_list">
		<li>
			<h3><i class="icon-compass"></i>複数ログイン方法</h3>
			<p>んがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがふがーーーーーーー</p>
		</li>
		<li>
			<h3><i class="icon-compass"></i>プログパーツ</h3>
			<p>んがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがふがーーーーーーー</p>
		</li>
		<li>
			<h3><i class="icon-compass"></i>スマホアプリ</h3>
			<p>んがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがんがふがーーーーーーー</p>
		</li>
	</ul>
</div>
<?=$this->element('create')?>