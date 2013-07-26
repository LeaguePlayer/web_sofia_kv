<div id="recent">
	<?foreach ($main_blocks as $key => $block):
		switch ($block->model) {
			case 'Catalog':
				$this->renderPartial('_catalog', array('block' => $block, 'i' => $key));
				break;
			case 'Action':
				$this->renderPartial('_action', array('block' => $block, 'i' => $key));
				break;
		}
	?>
	<?endforeach;?>
	<div class="clear"></div>
</div>