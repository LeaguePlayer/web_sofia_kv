<div id="recent">
	<div class="main-slider">
		<ul>
			<? foreach ($main_blocks as $key => $block) {
				echo CHtml::openTag('li');
				switch ($block->model) {
					case 'Catalog':
						$this->renderPartial('_catalog', array('block' => $block, 'i' => $key));
						break;
					case 'Action':
						$this->renderPartial('_action', array('block' => $block, 'i' => $key));
						break;
					case 'Page':
						$this->renderPartial('_page', array('block' => $block, 'i' => $key));
						break;
				}
				echo CHtml::closeTag('li');
			} ?>
		</ul>
	</div>
	<div class="clear"></div>
</div>