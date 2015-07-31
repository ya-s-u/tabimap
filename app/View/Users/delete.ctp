<div id="delete" class="main">
	<div class="container">
		<h2>Delete Your Account</h2>
		<p>We're sorry to see you go.</p>
		
	<?php
		echo $this->Form->create('User',array('class'=>''));
		echo $this->Form->textarea('comment');
		echo $this->Form->submit();
		echo $this->Form->end();
	?>
	</div>
</div>