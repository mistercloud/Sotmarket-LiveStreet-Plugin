{if $oUserCurrent->isAdministrator()}
<p>
	<script type="text/javascript">
		{literal}
		jQuery(document).ready(function($){
			jQuery('#tag_generator').click(function(){
				jQuery('#sotmarket_tag_modal').show();
				return false;
			});
			jQuery('#sotmarket_tag_modal .close').click(function(){
				jQuery('#sotmarket_tag_modal').hide();
				return false;
			});
			jQuery('#gen_tag').click(function(){
				var code = '';
				code += '{get_sotmarket';
				code += ' type='+$('#sotmarket-type').val();
				if ($('#sotmarket-product-id').val()){
					code += ' product_id='+$('#sotmarket-product-id').val();
				}
				if ($('#sotmarket-product-name').val()){
					code += ' product_name="'+$('#sotmarket-product-name').val()+'"';
				}
				if ($('#sotmarket-cnt').val()){
					code += ' cnt='+$('#sotmarket-cnt').val();
				}

				if ($('#sotmarket-image-size').val()){
					code += ' image_size='+$('#sotmarket-image-size').val();
				}
				if ($('#sotmarket-template').val()){
					code += ' template='+$('#sotmarket-template').val();
				}
				if ($('#sotmarket-cats').val()){
					code += ' categories='+$('#sotmarket-cats').val();
				}

				if ($('#sotmarket-fullstory').val()){
					code += ' topic_additional='+$('#sotmarket-fullstory').val();
				}
				code += '}';
				jQuery('#sotmarket_result').html(code);
				return false;
			});

		});
		{/literal}
	</script>
	<style>
		#sotmarket_dialog p {
			margin-bottom: 5px;
		}
	</style>
	<div id="sotmarket_tag_modal" class="modal" style="width:450px; top:5%">
		<header class="modal-header">
			<h3>Вставка Sotmarket тэга</h3>
			<a class="close jqmClose" href="#"></a>
		</header>
		<div class="modal-content" style="overflow-y: auto;height: 500px;">
			<div id="sotmarket_dialog" title="Генерация тега Сотмаркет">
				<p>
					<label>Тип тега</label>
					<select id="sotmarket-type">
						<option value="products" selected>Товары</option>
						<option value="related">Аксесуары</option>
						<option value="analog">Похожие товары</option>
					</select>
				</p>
				<p>
					<label>ID товара (товаров через запятую):</label>
					<input type="text" id="sotmarket-product-id" value="" />
				</p>
				<p>
					<label>Название товара:</label>
					<input type="text" id="sotmarket-product-name" value="" />
				</p>
				<p>
					<label>Сколько товаров выводить:</label>
					<input type="text" id="sotmarket-cnt" value="1" />
				</p>
				<p>
					<label>Размер картинки:</label>
					<select id="sotmarket-image-size">
						<option value="default" >стандартные</option>
						<option value="100x100">100x100</option>
						<option value="140x200">140x200</option>
						<option value="1200x1200">1200x1200</option>
						<option value="100x150">100x150</option>
						<option value="50x50">50x50</option>
					</select>
				</p>
				<p>
					<label>Шаблон:</label>
					<select id="sotmarket-template">
						{$sTemplates}
					</select>
				</p>
				<p>
					<label>ID категории (категорий через запятую):</label>
					<input type="text" id="sotmarket-cats" value="" />
				</p>
				<p>
					<label>Брать id или имя из дополнительного поля:</label>
					<select id="sotmarket-fullstory">
						<option value="0" >Нет</option>
						<option value="1">Да</option>
					</select>
				</p>
				<p>
					<a href="#" id="gen_tag">Сгенерировать тег</a>
				</p>
				<p>
					<span id="sotmarket_result"></span>
				</p>
			</div>
		</div>
	</div>
	<a href=="#" id="tag_generator">Сгенерировать тег Sotmarket</a>
</p>
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
