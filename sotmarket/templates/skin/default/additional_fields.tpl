{if $oUserCurrent->isAdministrator()}
<p>
	<label for="topic_sotmarket_ids">Id товара Sotmarket:</label>
	<input type="text" id="topic_sotmarket_ids" name="sotmarket_ids" value="{$_aRequest.topic_sotmarket_ids}" class="input-text input-width-full" />
	<small class="note">Можно несколько разделенных запятой , к примеру 10,40,100500</small>
</p>
<p>
	<label for="topic_sotmarket_name">Название товара Sotmarket:</label>
	<input type="text" id="topic_sotmarket_name" name="sotmarket_name" value="{$_aRequest.topic_sotmarket_name}" class="input-text input-width-full" />
	<small class="note">Система будет искать по названию или части названия (iPhone 4s или iPhone)</small>
</p>
{/if}
