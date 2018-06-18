{extends file="parent:frontend/detail/index.tpl"}

{block name="frontend_index_content"}
	{foreach $kmaEmotionArticleAbove as $kmaEmotion}
		<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
		<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
		</div>
		<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
	{/foreach}
	
	{$smarty.block.parent}
	{foreach $kmaEmotionArticleBelow as $kmaEmotion}
		<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
		<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
		</div>
		<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
	{/foreach}
	
{/block}

