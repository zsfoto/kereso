<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 * @var \Cake\Collection\CollectionInterface|string[] $countries
 * @var \Cake\Collection\CollectionInterface|string[] $counties
 */
?>
<?php
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;

$this->Form->setTemplates(Configure::read('Templates.form'));
$this->assign('title', __('Add') . ' ' . __('City'));
?>
				<div id="form-row" class="cities row">
					<div class="col-xs-12 col-xl-10">
						<div class="card mb-3">
							<div class="card-header">

								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-plus fa-spin"></i> <?= __('Add') ?>: <?= __('City') ?></h3>
									<?= __('The data marked with <span class="fw-bold text-danger">*</span> must be provided!') ?>
								</div>

								<div class="float-end ms-5">
									<?= $this->Html->link('<span class="btn btn-outline-secondary mt-1 me-1"><i class="fa fa-times"></i></span>',
										["controller" => "Cities", "action" => "index", "_full" => true],
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

							<?= $this->Form->create($city, ['id' => 'main-form']) ?>
							
								<?php //= $this->Form->control('_csrfToken', ['name' => '_csrfToken', 'type' => 'hidden', 'value' => $this->request->getAttribute('csrfToken')] ) ?>

								<div class="card-body">
								
									<div class="tab-content" id="tabContent">
										
										<div class="tab-pane fade show active" id="tabPanelMain" role="tabpanel" aria-labelledby="tabMain" tabindex="0">

											<!-- 1. SELECT: country_id: integer  required -->
											<div class="mb-3 form-group row select required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="country-id"><?= __('Country Id') ?>:</label>
												<div class="col-md-4">
													<?= $this->Form->control('country_id', ['options' => $countries, 'placeholder' => __('Country Id'), 'class' => 'form-control select2', 'data-live-search' => false, 'data-container' => 'body', 'data-size' => '6', 'empty' => false]);	?>

												</div>
											</div>

											<!-- 1. SELECT: county_id: integer  required -->
											<div class="mb-3 form-group row select required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="county-id"><?= __('County Id') ?>:</label>
												<div class="col-md-4">
													<?= $this->Form->control('county_id', ['options' => $counties, 'placeholder' => __('County Id'), 'class' => 'form-control select2', 'data-live-search' => false, 'data-container' => 'body', 'data-size' => '6', 'empty' => false]);	?>

												</div>
											</div>

											<!-- 2. STRING: shortname: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="shortname"><?= __('Shortname') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('shortname', ['label' => __('Shortname'), 'placeholder' => __('Shortname'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: name: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="name"><?= __('Name') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('name', ['label' => __('Name'), 'placeholder' => __('Name'), 'class' => 'form-control', 'empty' => false, 'autofocus' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: zip: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="zip"><?= __('Zip') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('zip', ['label' => __('Zip'), 'placeholder' => __('Zip'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: lat: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="lat"><?= __('Lat') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('lat', ['label' => __('Lat'), 'placeholder' => __('Lat'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: lng: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="lng"><?= __('Lng') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('lng', ['label' => __('Lng'), 'placeholder' => __('Lng'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: lat2: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="lat2"><?= __('Lat2') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('lat2', ['label' => __('Lat2'), 'placeholder' => __('Lat2'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: lng2: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="lng2"><?= __('Lng2') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('lng2', ['label' => __('Lng2'), 'placeholder' => __('Lng2'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

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
										["controller" => "Cities", "action" => "index", "_full" => true],
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
			//"jeffAdmin5./assets/plugins/tempus-dominus-6.0.0/dist/css/tempus-dominus.min",
			//"jeffAdmin5./assets/plugins/summernote-0.8.18-dist/summernote-lite.min",
			"jeffAdmin5./assets/plugins/bootstrap-select-main/docs/docs/dist/css/bootstrap-select.min",
			//"jeffAdmin5./assets/plugins/icheck-1.0.3/skins/all",

			// "jeffAdmin5./assets/plugins/select2-4.1.0-rc.0/dist/css/select2.min",	// If you want to use Select 2, but it's not finish!!!
			// "jeffAdmin5./assets/css/select2-bootstrap-5-theme.min",					// If you want to use Select 2, but it's not finish!!!
		],
		['block' => true]);


	$this->Html->script(
		[
			//"jeffAdmin5./assets/js/popper",
			//"jeffAdmin5./assets/plugins/tempus-dominus-6.0.0/dist/js/tempus-dominus.min",	// Must be loaded the popper.js !!
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

	jeffAdminInitSelectPicker()
	jeffAdminInitInputSpinner()
	//jeffAdminInitICheck('icheckbox_flat-blue');

	$(document).ready( function(){
		$('#button-submit').click( function(){
			$('#main-form').submit();
		});			
	});			

<?php $this->Html->scriptEnd(['block' => 'javaScriptBottom']); ?>
