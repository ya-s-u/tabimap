<div class="m_create_map remodal" data-remodal-id="createMap">
	<div class="m_create_map_head">
		<p class="m_create_map_head_title">訪れたことのある国を選択して下さい</p>
		<p class="m_create_map_head_sum">：<i id="EditSum">0</i>カ国</p>
	    <a class="m_create_map_head_close" href="#">閉じる</a>
		<ul class="m_create_map_menu">
			<li id="MapMode" class="active">地図から選ぶ</li>
			<li id="FlagMode">国旗から選ぶ</li>
		</ul>
	</div>
	<div id="Map" class="m_create_map_whole">
		<div id="svg_map" class="m_create_map_svgmap" style="width: 1200px; height: 700px;"></div>
	</div>
	<div id="FlagSelect" class="m_create_map_flag" style="display:none">
	    <ul class="m_create_map_flag_list">
			<?php
			foreach($Country as $code => $country) {
				echo '<li name="'.$code.'"><i class="flag49 flag49_'.$code.'"></i>'.$country.'</li>';
			}
			?>
		</ul>
	</div>
	<div class="m_create_map_bottom">
		<p class="m_create_map_bottom_text"><a href="/terms" target="_blank">利用規約</a>に同意した上で登録してください。登録にはTwitterアカウントが必要です。 ※年齢と性別は公開されず、統計処理にのみ用いられます</p>
		<div class="m_create_map_bottom_inputs">
			<input id="Age" class="m_create_map_bottom_age" type="text" maxlength="2" placeholder="99">
			<p class="m_create_map_bottom_age_sub">歳</p>
			<ul id="Sex" class="m_create_map_bottom_sex">
				<li class="man" name="man">男性</li>
				<li class="woman" name="woman">女性</li>
			</ul>
			<p id="Submit" class="b_create_map_submit"><i class="icon-twitter"></i>この内容で登録する</p>
		</div>
	</div>
</div>
<?php
echo $this->Form->create('User',array('class'=>''));
foreach($Country as $key => $value) {
	echo $this->Form->hidden($key, array('value'=>0));
};
echo $this->Form->hidden('age');
echo $this->Form->hidden('sex');
echo $this->Form->end();
?>