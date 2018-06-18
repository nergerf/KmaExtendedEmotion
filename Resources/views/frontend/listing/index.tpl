{extends file="parent:frontend/listing/index.tpl"}

{block name="frontend_listing_index_listing"}
	{foreach $kmaEmotionCategoryAbove as $kmaEmotion}
		<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
		</div>
	{/foreach}
	
	{$smarty.block.parent}
	
	{foreach $kmaEmotionCategoryBelow as $kmaEmotion}
		<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
		</div>
	{/foreach}
{/block}
