{extends file="parent:frontend/custom/index.tpl"}

{* Main content *}
{block name="frontend_index_content"}
	{foreach $kmaEmotionCustomAbove as $kmaEmotionAbove}
		<div class="emotion--wrapper kma-wrapper-above" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotionAbove.id}" data-availableDevices="{$kmaEmotionAbove.device}">
		</div>
	{/foreach}

	{$smarty.block.parent}

	{foreach $kmaEmotionCustomleBelow as $kmaEmotionBelove}
		<div class="emotion--wrapper kma-wrapper-belove" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotionBelove.id}" data-availableDevices="{$kmaEmotionBelove.device}">
		</div>
	{/foreach}
{/block}