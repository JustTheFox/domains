<?php

namespace app\components;

use Yii;
use yii\base\Widget;

class InfoMessageWidget extends Widget
{
   
    public function run()
    {
    	
    }

    
}

?>
<?php 

	$show = false;
	$data = Yii::$app->session->get("infoMessage");
	if($data) {
		$show = true;
		Yii::$app->session->remove("infoMessage");
	}
 ?>
<?php if($show) {?>
<div class="alert alert-<?=$data["color"]?> text-center">
 	<?=$data["message"]?>
 	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
</div>
<?php }?>
