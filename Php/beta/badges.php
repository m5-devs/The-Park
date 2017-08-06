<style>
	#badge {
		width: 150px;
		border-radius: 50%;
		border: 1px solid black;
	}
</style>

<span class="card-title">Badges</span>
<br/>

<?php
	if ($currentuser['privilege'] != 0) { // Member Badge
		echo " 
			<img src='favicon.ico' id='badge' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Member Badge'/>
			<a class='modal-trigger waves-effect waves-light btn' href='#AllBadges'>All Badges</a>
		";
	}
	else {
		echo "
			<img src='' id='badge'class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Badge Not Owned Yet!'/>
			<a class='modal-trigger waves-effect waves-light btn' href='#AllBadges'>All Badges</a>
		";
	}
?>

<div id="AllBadges" class="modal modal-fixed-footer">
	<div class="modal-content">
	<?php 
		if($currentuser['privilege'] != 0) {
			echo "
			<img src='favicon.ico' id='badge' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Member Badge'/>
			";
		}
		else {
			echo "
			<img src='' id='badge'class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Badge Not Owned Yet!'/>
			";
		}
		if($currentuser['points'] >= 500) {
			echo "
			<img src='res/img/badges/500point.png' id='badge' class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='500 Points Earned!'/>
			";
		}
		else {
			echo "
			<img src='' id='badge'class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Badge Not Owned Yet!'/>
			";
		}
		if($currentuser['points'] >= 1000) {
			echo "
			<img src='res/img/badges/500point.png' id='badge' class='tooltipped' data-position='bottom' data-delay='50' data-tooltibottom00 Points Earned!'/>
			";
		}
		else {
			echo "
			<img src='' id='badge'class='tooltipped' data-position='bottom' data-delay='50' data-tooltip='Badge Not Owned Yet!'/>
			";
		}
	?>	
	</div>
	
	<div class="modal-footer">
	  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Done</a>
	</div>
</div>