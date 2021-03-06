<?php
	include_once "common/base.php";
	$pageTitle = "Closet";
	include_once "common/header.php";
?>
				<div class="full" id="main">
					<noscript>This site just doesn't work, period, without JavaScript</noscript>
 <?php
 	if(isset($_SESSION['LoggedIn']) && isset($_SESSION['Username'])):
 		echo "<table class=\"table table-hover\" id=\"list\">";
 		echo "<tr>
 						<td><b>Name</b></td>
 						<td><b>Type</b></td>
						<td><b>Action</b></td>
 					</tr>";

 		include_once 'inc/class.items.inc.php';
		include_once 'inc/class.users.inc.php';
 		$items = new FocusItems($db);
		$users = new FocusUsers($db);
		list($userID, $v) = $users->retrieveAccountInfo();
 		$items->loadItemsByUser();

 		echo "</table>";
 ?>

					 </br>
					 <div id="form-content" class="modal fade" tabindex="-1" role="dialog">
						 <div class="modal-dialog" role="document">
    			 		<div class="modal-content">
								<form class="form-horizontal" role="form"  id="add-new" method="post" action="db-interaction/items.php">
								 <div class="modal-header">
									 <a class="close" data-dismiss="modal">×</a>
								 </div>
								 <div class="modal-body">
									 	<div class="form-group">
									 		<div class="col-xs-offset-2 col-xs-8">
									 			<input type="hidden" id="userid" name="userid" value="<?php echo $userID ?>" />
									 			<input type="text" class="form-control" id="ID" name="ID" placeholder="ID" value="">
									 		</div>
									 	</div>
									 	<div class="form-group">
									 		<div class="col-xs-offset-2 col-xs-8">
									 			<label class="radio-inline"><input type="radio" id="Type" name="Type" value="Top"><b>Top</b></label>
									 			<label class="radio-inline"><input type="radio" id="Type" name="Type" value="Bottom"><b>Bottom</b></label>
									 			<label class="radio-inline"><input type="radio" id="Type" name="Type" value="Full"><b>Full</b></label>
									 		</div>
									 	</div>
									 	<div class="form-group">
									 		<div class="col-xs-offset-2 col-xs-8">
									 			<div class="input-group colorpicker-component">
									 				<input type="text" id="ItemColor" name="ItemColor" placeholder="Color" class="form-control" value=""/>
									 				<span class="input-group-addon"><i></i></span>
									 			</div>
									 		</div>
									 	</div>
									 	<br/>
									 	<div class="form-group">
									 		<div class="col-xs-offset-2 col-xs-8">
									 			<p class="featureSlider">
									 				<b class="leftLabel">Thin</b>
									 				<input id="Thickness" name="Thickness" value="3" type="text" class="span2" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3" data-slider-orientation="horizontal">
									 				<b class="rightLabel">Thick</b>
									 			</p>
									 			<br/>
									 			<p class="featureSlider">
									 				<b class="leftLabel">Casual</b>
									 				<input id="Formality" name="Formality" value="3" type="text" class="span2" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3" data-slider-orientation="horizontal">
									 				<b class="rightLabel">Formal</b>
									 			</p>
									 			<br/>
									 			<p class="featureSlider">
									 				<b class="leftLabel">Short</b>
									 				<input id="Length" name="Length" value="2" type="text" class="span2" data-slider-min="1" data-slider-max="3" data-slider-step="1" data-slider-value="2" data-slider-orientation="horizontal">
									 				<b class="rightLabel">Long</b>
									 			</p>
									 			<br/>
									 			<p class="featureSlider">
									 				<b class="leftLabel">Unattractive</b>
									 				<input id="Attractiveness" name="Attractiveness" value="3" type="text" class="span2" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3" data-slider-orientation="horizontal">
									 				<b class="rightLabel">Attractive</b>
									 			</p>
									 			<br/>
									 			<p class="featureSlider">
									 				<b class="leftLabel">Slim</b>
									 				<input id="Fitness" name="Fitness" value="3" type="text" class="span2" data-slider-min="1" data-slider-max="5" data-slider-step="1" data-slider-value="3" data-slider-orientation="horizontal">
									 				<b class="rightLabel">Large</b>
									 			</p>
									 		</div>
									 	</div>
									 </div>
									 <div class="modal-footer">
										 <button type="submit" id="add-new-submit" class="btn btn-success">Add Item</button>
										 <a href="#" class="btn" data-dismiss="modal">Cancel</a>
									 </div>
								 </form>
							 </div>
						 </div>
					 </div>
					 <button class="btn btn-primary" data-toggle="modal" data-target="#form-content">
					  Add new item
					 </button>
				</div>

				<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
				 <script type="text/javascript" src="js/items.js"></script>
				 <script type="text/javascript">
                initialize();
    		</script>



<?php endif; ?>



<?php
	include_once 'common/close.php';
?>
