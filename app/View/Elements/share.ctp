<div id="ModalShareMap" class="remodal" data-remodal-id="shareMap">
	<div class="head">
		<p><i class="icon-twitter"></i>このマップをシェアする</p>
	    <a class="remodal-close" href="#">キャンセル</a>
	</div>
	<div class="map">
		<div id="friends_map2" style="width: 400px; height: 200px;"></div>
	</div>
	<?php
		echo $this->Form->create('User',array('class'=>''));
		echo $this->Form->textarea('text',array('rows' => '8','default' => '現在テスト中につき、この機能はご利用になれません。'));
		echo $this->Form->end();
	?>
	<a class="remodal-submit" href="#">ツイートする</a>
</div>