{extends file="parent:frontend/blog/detail.tpl"}

{block name='frontend_index_content'}
	<div class="blog--content block-group">
		{foreach $kmaEmotionBlogAbove as $kmaEmotion}
			<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
			<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
				<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
			</div>
		{/foreach}

		{$smarty.block.parent}

		{foreach $kmaEmotionBlogBelow as $kmaEmotion}
			<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
			<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
				<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
			</div>
		{/foreach}
	</div>
{/block}