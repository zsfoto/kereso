<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 * @var string[]|\Cake\Collection\CollectionInterface $icons
 * @var string[]|\Cake\Collection\CollectionInterface $companies
 */
?>
<?php
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;

$this->Form->setTemplates(Configure::read('Templates.form'));
$this->assign('title', __('Edit') . ' ' . __('Person'));
?>
				<div id="form-row" class="persons row">
					<div class="col-xs-12 col-xl-10">
						<div class="card mb-3">
							<div class="card-header">

								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-edit fa-spin"></i> <?= __('Edit') ?>: <?= __('Person') ?></h3>
									<?= __('The data marked with <span class="fw-bold text-danger">*</span> must be provided!') ?>
								</div>

								<div class="float-end ms-5">
									<?= $this->Html->link('<span class="btn btn-outline-secondary mt-1 me-1"><i class="fa fa-times"></i></span>',
										["controller" => "Persons", "action" => "index", "_full" => true],
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

							<?= $this->Form->create($person, ['id' => 'main-form']) ?>
							
								<?php //= $this->Form->control('_csrfToken', ['name' => '_csrfToken', 'type' => 'hidden', 'value' => $this->request->getAttribute('csrfToken')] ) ?>

								<div class="card-body">
								
									<div class="tab-content" id="tabContent">
										
										<div class="tab-pane fade show active" id="tabPanelMain" role="tabpanel" aria-labelledby="tabMain" tabindex="0">

											<!-- 1. SELECT: icon_id: integer  -->
											<div class="mb-3 form-group row select required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="icon-id"><?= __('Icon Id') ?>:</label>
												<div class="col-md-4">
													<?= $this->Form->control('icon_id', ['options' => $icons, 'placeholder' => __('Icon Id'), 'class' => 'form-control select2', 'data-live-search' => false, 'data-container' => 'body', 'data-size' => '6', 'empty' => true]);	?>

												</div>
											</div>

											<!-- 1. SELECT: company_id: integer  required -->
											<div class="mb-3 form-group row select required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="company-id"><?= __('Company Id') ?>:</label>
												<div class="col-md-4">
													<?= $this->Form->control('company_id', ['options' => $companies, 'placeholder' => __('Company Id'), 'class' => 'form-control select2', 'data-live-search' => false, 'data-container' => 'body', 'data-size' => '6', 'empty' => false]);	?>

												</div>
											</div>

											<!-- 2. STRING: name: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="name"><?= __('Name') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('name', ['label' => __('Name'), 'placeholder' => __('Name'), 'class' => 'form-control', 'empty' => false, 'autofocus' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: name_slug: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="name-slug"><?= __('Name Slug') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('name_slug', ['label' => __('Name Slug'), 'placeholder' => __('Name Slug'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: description: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="description"><?= __('Description') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('description', ['label' => __('Description'), 'placeholder' => __('Description'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: keywoords: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="keywoords"><?= __('Keywoords') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('keywoords', ['label' => __('Keywoords'), 'placeholder' => __('Keywoords'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: keywoords_slug: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="keywoords-slug"><?= __('Keywoords Slug') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('keywoords_slug', ['label' => __('Keywoords Slug'), 'placeholder' => __('Keywoords Slug'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: phone: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="phone"><?= __('Phone') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('phone', ['label' => __('Phone'), 'placeholder' => __('Phone'), 'class' => 'form-control', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: phone2: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="phone2"><?= __('Phone2') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('phone2', ['label' => __('Phone2'), 'placeholder' => __('Phone2'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: phone3: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="phone3"><?= __('Phone3') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('phone3', ['label' => __('Phone3'), 'placeholder' => __('Phone3'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: phone4: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="phone4"><?= __('Phone4') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('phone4', ['label' => __('Phone4'), 'placeholder' => __('Phone4'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: phone5: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="phone5"><?= __('Phone5') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('phone5', ['label' => __('Phone5'), 'placeholder' => __('Phone5'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: email: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="email"><?= __('Email') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('email', ['label' => __('Email'), 'placeholder' => __('Email'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: email2: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="email2"><?= __('Email2') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('email2', ['label' => __('Email2'), 'placeholder' => __('Email2'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: web: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="web"><?= __('Web') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('web', ['label' => __('Web'), 'placeholder' => __('Web'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: facebook: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="facebook"><?= __('Facebook') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('facebook', ['label' => __('Facebook'), 'placeholder' => __('Facebook'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: youtube: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="youtube"><?= __('Youtube') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('youtube', ['label' => __('Youtube'), 'placeholder' => __('Youtube'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: logo: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="logo"><?= __('Logo') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('logo', ['label' => __('Logo'), 'placeholder' => __('Logo'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 2. STRING: banner: string  -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end" for="banner"><?= __('Banner') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('banner', ['label' => __('Banner'), 'placeholder' => __('Banner'), 'class' => 'form-control', 'empty' => true]); ?>

												</div>
											</div>

											<!-- 7. BOOLEAN: visible: boolean  required -->
											<div class="mb-3 form-group row checkbox">
												<div class="col-sm-2 col-form-label required"></div>
												<div class="col-sm-10">
													<?= $this->Form->control('visible', ['empty' => false]); ?>

												</div>
											</div>

											<!-- 3. INTEGER: pos: integer  required -->
											<div class="mb-3 form-group row number required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="pos"><?= __('Pos') ?>:</label>
												<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-xl-4 col-xxl-4">
													<?= $this->Form->control('pos', ['class' => 'form-control', 'placeholder' => __('Pos'), 'data-decimals' => '0', 'min' => '0', 'max' => '999999999999', 'step' => '1', 'empty' => false]); ?>

												</div>
											</div>

											<!-- 2. STRING: action: string  required -->
											<div class="mb-3 form-group row text required">
												<label class="col-form-label col-md-2 pt-1 text-start text-md-end required" for="action"><?= __('Action') ?>:</label>
												<div class="col-md-9">
													<?= $this->Form->control('action', ['label' => __('Action'), 'placeholder' => __('Action'), 'class' => 'form-control', 'empty' => false]); ?>

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
										["controller" => "Persons", "action" => "index", "_full" => true],
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
			"jeffAdmin5./assets/plugins/icheck-1.0.3/skins/all",

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
			"jeffAdmin5./assets/plugins/icheck-1.0.3/icheck.min",
			
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
	jeffAdminInitICheck('icheckbox_flat-blue');

	$(document).ready( function(){
		$('#button-submit').click( function(){
			$('#main-form').submit();
		});			
	});			

<?php $this->Html->scriptEnd(['block' => 'javaScriptBottom']); ?>
