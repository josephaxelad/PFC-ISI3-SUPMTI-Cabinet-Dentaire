<?php 
	
	/**
	 * 
	 */
	class Session
	{
		
		public function __construct()
		{
			session_start();
		}
		public function setFlash($message,$type = 'error',$n = '0'){
			$_SESSION["flash"]=array('message' => $message ,'type' => $type, 'n' => $n );
		}
		public function flash(){
			if (isset($_SESSION["flash"])) {
				?>
				<div id="alert-<?php echo($_SESSION["flash"]["n"]) ?>" style="text-align: center;" class="alert alert-<?php echo($_SESSION["flash"]["type"]) ?>">
					<?php 
					switch ($_SESSION["flash"]["n"]) {
						case '1':
							?><a class="close">x</a><?php
							break;
						
						default:
							# code...
							break;
					}
					 ?>
                  	<?php echo($_SESSION["flash"]["message"]); ?>
                </div>
				<?php
				unset($_SESSION["flash"]);
			}
		}
	}
 ?>