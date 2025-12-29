<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country $country
 */
?>
<?php
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;

$this->Form->setTemplates(Configure::read('Templates.form'));
$this->assign('title', __('Edit') . ' ' . __('Country'));
?>
				<div id="form-row" class="countries row">
					<div class="col-xs-12 col-xl-10">
						<div class="card mb-3">
							<div class="card-header">

								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-edit fa-spin"></i> <?= __('Edit') ?>: <?= __('Country') ?></h3>
									<?= __('The data marked with <span class="fw-bold text-danger">*</span> must be provided!') ?>
								</div>

								<div class="float-end ms-5">
									<?= $this->Html->link('<span class="btn btn-outline-secondary mt-1 me-1"><i class="fa fa-times"></i></span>',
										["controller" => "Countries", "action" => "index", "_full" => true],
										["escape" => false, "role" => "button"]
									); ?>

								</div>

								<div class="form-tab float-end">
									<ul class="nav nav-tabs mt-1" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active" id="tabMain" data-bs-toggle="tab" data-bs-target="#tabPanelMain" type="button" role="tab" aria-controls="tabPanelMain" aria-selected="true"><?= __('Basic data') ?></button>
										</li>

<?php /*
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tabSecond" data-bs-toggle="tab" data-bs-target="#tabPanelSecond" type="button" role="tab" aria-controls="tabPanelSecond" aria-selected="false"><?= __('Memo') ?></button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tabMore" data-bs-toggle="tab" data-bs-target="#tabPanelMore" type="button" role="tab" aria-controls="tabPanelMore" aria-selected="false"><?= __('More') ?></button>
										</li>
*/ ?>

									</ul>
								</div>

							</div>

							<?= $this->Form->create($country, ['id' => 'main-form']) ?>
							
								<?php //= $this->Form->control('_csrfToken', ['name' => '_csrfToken', 'type' => 'hidden', 'value' => $this->request->getAttribute('csrfToken')] ) ?>

								<div class="card-body">
								
									<div class="tab-content" id="tabContent">
										
										<div class="tab-pane fade show active" id="tabPanelMain" role="tabpanel" aria-labelledby="tabMain" tabindex="0">

											<!-- 2. STRING: name_hu: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="name-hu"><?= __('Name Hu') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('name_hu', ['label' => __('Name Hu'), 'placeholder' => __('Name Hu'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: name_en: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="name-en"><?= __('Name En') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('name_en', ['label' => __('Name En'), 'placeholder' => __('Name En'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: name_de: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="name-de"><?= __('Name De') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('name_de', ['label' => __('Name De'), 'placeholder' => __('Name De'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: shortcode: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="shortcode"><?= __('Shortcode') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('shortcode', ['label' => __('Shortcode'), 'placeholder' => __('Shortcode'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: currency: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="currency"><?= __('Currency') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('currency', ['label' => __('Currency'), 'placeholder' => __('Currency'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 3. INTEGER: pos: integer  required -->
											<div class="mb-3 form-group row number required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="pos"><?= __('Pos') ?>:</label>
												<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 col-xxl-4">
													<?= $this->Form->control('pos', ['class' => 'form-control', 'placeholder' => __('Pos'), 'data-decimals' => '0', 'min' => '0', 'max' => '999999999999', 'step' => '1', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 8. ELSE: visible: tinyinteger  required not in ['string', 'integer', 'datetime', 'date', 'time', 'boolean'] -->
											<?php //$this->Form->control('visible', ['class' => 'form-control']); ?>
										</div><!-- /.tabPanelMain -->
										
										
<?php /*											
										<div class="tab-pane fade" id="tabPanelMore" role="tabpanel" aria-labelledby="tabMore" tabindex="0">
											<h3>More content come here...</h3>

										</div><!-- /.N.TAB -->
*/ ?>

									</div><!-- /.TAB PANEL -->
										
								</div>

								<div class="card-footer text-center">
									<?= $this->Form->button('<span class="btn-label"><i class="fa fa-save"></i></span>' . __('Save'), ["escapeTitle" => false, "type" => "submit", "class" => "btn btn-primary me-4"]) ?>
									
									<?= $this->Html->link('<span class="btn-label"><i class="fa fa-arrow-up"></i></span>' . __("Cancel"),
										["controller" => "Countries", "action" => "index", "_full" => true],
										["escape" => false, "role" => "button", "class" => "btn btn-outline-secondary"]
									); ?>
									
								</div>

							<?= $this->Form->end() ?>

						</div><!-- end card-->
                    </div>


				</div>			


<?php
	$this->Html->css(
		[
			"jeffAdmin5./assets/plugins/tempus-dominus-6.0.0/dist/css/tempus-dominus.min",
			"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/summernote-lite.min",
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/css/bootstrap-select.min",
			//"jeffAdmin5./assets/plugins/icheck-1.0.3/skins/all",

			// "jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/css/select2.min",	// If you want to use Select 2, but it's not finish!!!
			// "jeffAdmin5./assets/css/select2-bootstrap-5-theme.min",					// If you want to use Select 2, but it's not finish!!!
		],
		['block' => true]);


	$this->Html->script(
		[
			"jeffAdmin5./assets/js/popper",
			"jeffAdmin5./assets/plugins/tempus-dominus-6.0.0/dist/js/tempus-dominus.min",	// Must be loaded the popper.js !!
			"jeffAdmin5./assets/plugins/bootstrap-input-spinner-bs-5/src/bootstrap-input-spinner",
			//"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/summernote-lite.min",
			//"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/lang/summernote-hu-HU",
			//'jeffAdmin5./assets/plugins/jReadMore-master/dist/read-more.min',
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/js/bootstrap-select.min",
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/js/i18n/defaults-hu_HU.min",
			//"jeffAdmin5./assets/plugins/icheck-1.0.3/icheck.min",
			
			//"jeffAdmin5./assets/plugins/jquery-copy-to-clipboard-master/jquery.copy-to-clipboard",
			
			//'jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/js/select2.full.min',	// If you want to use Select 2, but it's not finish!!!
			//'jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/js/i18n/hu',			// If you want to use Select 2, but it's not finish!!!
		],
		['block' => 'scriptBottom']
	); ?>
		
<?php
	// SELECT: https://developer.snapappointments.com/bootstrap-select/examples/
?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']); ?>

	jeffAdminInitInputSpinner()
	//jeffAdminInitICheck('icheckbox_flat-blue');

	$(document).ready( function(){
		$('#button-submit').click( function(){
			$('#main-form').submit();
		});			
	});			

<?php $this->Html->scriptEnd(['block' => 'javaScriptBottom']); ?>
