<?php $this->addCSS('templates/'.$this->name.'/controllers/horoscope/assets/css/custombox.min.css');?>
<?php $this->addCSS('templates/'.$this->name.'/controllers/horoscope/widgets/default/assets/css/default.css');?>
<?php $this->addJS('templates/'.$this->name.'/controllers/horoscope/assets/js/custombox.min.js');?>
<?php $this->addJS('templates/'.$this->name.'/controllers/horoscope/assets/js/init.js');?>
<?php if ($data) { ?>
	<div class="horoscope default">
		<?php foreach ($data as $key=>$item) { ?>
			<div class="<?php echo $key;?> item" data-name="<?php echo $key;?>">
				<div class="icon"></div>
				<div class="name"><?php echo $item['name']; ?></div>
			</div>
		<?php } ?>
	</div>
<?php } ?>
