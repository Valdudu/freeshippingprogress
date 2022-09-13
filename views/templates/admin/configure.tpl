{*
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<form id="module_form" class="defaultForm form-horizontal" action="http://localhost/prestashop7/admin546avjlip/index.php?controller=AdminModules&amp;configure=freeshippingprogress&amp;tab_module=administration&amp;module_name=freeshippingprogress&amp;token=fdd22ee1caf2a6d14a520871f909b6ad" method="post" enctype="multipart/form-data" validate>
<input type="hidden" name="submitFreeshippingprogressModule" value="1">
	<div class="panel" id="fieldset_0">
		<div class="panel-heading">
			<i class="icon-cogs"></i>							Settings
		</div>
		<div class="form-wrapper">
			<div class="form-group">
				<label class="control-label col-lg-3 required">
					{l s='Enter amount to reach' mod='freeshippingprogress'}
				</label>
				<div class="col-lg-3">
					<div class="input-group">				
						<input type="text" name="FREESHIPPINGPROGRESS_PRICE" id="FREESHIPPINGPROGRESS_PRICE" value="{$FREESHIPPINGPROGRESS_PRICE}" class="" required="required">
						<span class="input-group-addon">
							<i class="icon icon-currency">€</i>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">
					{l s='Image for the Store Locator' mod='freeshippingprogress'}
				</label>
				<div class="col-lg-9">
					<div class="form-group">
						<div class="col-lg-12">
							<div>
								<img src={$img} alt="" title="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-3">
					{l s='Image' mod='freeshippingprogress'}
				</label>
				<div class="col-lg-9">
					<div class="form-group">
						<div class="col-sm-6">
							<input id="FREESHIPPINGPROGRESS_IMG_LINK" type="file" name="FREESHIPPINGPROGRESS_IMG_LINK" class="hide">
							<div class="dummyfile input-group">
								<span class="input-group-addon"><i class="icon-file"></i></span>
								<input id="FREESHIPPINGPROGRESS_IMG_LINK-name" type="text" name="FREESHIPPINGPROGRESS_IMG_LINK" readonly="">
								<span class="input-group-btn">
									<button id="FREESHIPPINGPROGRESS_IMG_LINK-selectbutton" type="button" name="submitAddAttachments" class="btn btn-default">
										<i class="icon-folder-open"></i> Ajouter un fichier				
									</button>
								</span>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						$(document).ready(function(){
						$('#FREESHIPPINGPROGRESS_IMG_LINK-selectbutton').click(function(e) {
						$('#FREESHIPPINGPROGRESS_IMG_LINK').trigger('click');
						});

						$('#FREESHIPPINGPROGRESS_IMG_LINK-name').click(function(e) {
						$('#FREESHIPPINGPROGRESS_IMG_LINK').trigger('click');
						});

						$('#FREESHIPPINGPROGRESS_IMG_LINK-name').on('dragenter', function(e) {
						e.stopPropagation();
						e.preventDefault();
						});

						$('#FREESHIPPINGPROGRESS_IMG_LINK-name').on('dragover', function(e) {
						e.stopPropagation();
						e.preventDefault();
						});

						$('#FREESHIPPINGPROGRESS_IMG_LINK-name').on('drop', function(e) {
						e.preventDefault();
						var files = e.originalEvent.dataTransfer.files;
						$('#FREESHIPPINGPROGRESS_IMG_LINK')[0].files = files;
						$(this).val(files[0].name);
						});

						$('#FREESHIPPINGPROGRESS_IMG_LINK').change(function(e) {
						if ($(this)[0].files !== undefined)
						{
						var files = $(this)[0].files;
						var name  = '';

						$.each(files, function(index, value) {
						name += value.name+', ';
						});

						$('#FREESHIPPINGPROGRESS_IMG_LINK-name').val(name.slice(0, -2));
						}
						else // Internet Explorer 9 Compatibility
						{
						var name = $(this).val().split(/[\\/]/);
						$('#FREESHIPPINGPROGRESS_IMG_LINK-name').val(name[name.length-1]);
						}
						});

						if (typeof FREESHIPPINGPROGRESS_IMG_LINK_max_files !== 'undefined')
						{
						$('#FREESHIPPINGPROGRESS_IMG_LINK').closest('form').on('submit', function(e) {
						if ($('#FREESHIPPINGPROGRESS_IMG_LINK')[0].files.length > FREESHIPPINGPROGRESS_IMG_LINK_max_files) {
						e.preventDefault();
						alert('Vous pouvez ajouter  images au maximum.');
						}
						});
						}
						});
					</script>
				</div>
			</div>
		</div><!-- /.form-wrapper -->
		<div class="panel-footer">
			<button type="submit" value="1" id="module_form_submit_btn" name="submitFreeshippingprogressModule" class="btn btn-default pull-right">
				<i class="process-icon-save"></i> Enregistrer
			</button>
		</div>
	</div>
</form>