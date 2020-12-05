<?php
	if(!empty($policyData))
	{
		?>
		<div class="container">
			<div>
				<h1 class="policy_title"><?=$policyTitle?></h1>
				<p><?=$policyData->description;?></p>
			</div>
		</div>
		<?php
	}
?>
