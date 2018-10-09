<?php if (!$is_sort) { ?>
<div class="horoscope-popup" id="horoscope-popup">
<?php } ?>
	<div class="header <?php echo $name;?>">
		<div class="icon"></div>
		<div class="info">
			<div class="forecast"><?php echo $data['forecast'];?></div>
			<div class="title"><?php echo $data['title'];?></div>
			<div class="sort">
                <?php foreach ($plan as $key=>$rec) { ?>
                    <span class="plan<?php if ($key===$sort) {echo ' active';} ?>" data-name="<?php echo $name;?>" data-sort="<?php echo $key;?>"><?php echo $rec['name']; ?></span>
                <?php } ?>
            </div>
		</div>
	</div>
	<div class="content"><?php echo $data['text'];?></div>
<?php if (!$is_sort) { ?>
</div>
<?php } ?>
