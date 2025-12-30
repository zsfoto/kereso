<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Person> $persons
 */
use Cake\Core\Configure;

$layoutPersonsLastId = -1;
if($session->check('Layout.Persons.LastId')){
	$layoutPersonsLastId = $session->read('Layout.Persons.LastId');
}

$global_config = (array) Configure::read('Theme.' . $prefix . '.config.template.index');
$local_config = [
	'show_id' 			=> true,
	'show_pos' 			=> false,
	'show_counters'		=> false,
	'action_db_click'	=> 'edit',	// none, edit or view
	// ... more config params in: \JeffAdmin5\config\jeffadmin5.php
];
$config = array_merge($global_config, $local_config);
?>
				<div class="persons index row">
						
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card">
							<div class="card-header">
							
								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-table fa-spin"></i> <?= __('Table') ?>: <?= __('Persons') ?></h3>
									<div><?php
										if($config['action_db_click'] == 'edit'){
											echo __('Double clik to edit row');
										}
										if($config['action_db_click'] == 'view'){
											echo __('Double clik to view row');
										}
									?></div>
								</div>
								
								<div class="float-end">
									<!-- Paginator page links -->
									<?= $this->element('JeffAdmin5.paginator') ?>
									<!-- /.Pginator page links -->
								</div>
								
							</div>

<?php ####################################################################################################################################################### ?>
<?php ###################### CARD BODY ###################################################################################################################### ?>
<?php ####################################################################################################################################################### ?>

							<div class="card-body p-0 p-1">
								
								<table class="table table-responsive-xl table-hover table-striped mb-0 text-nowrap" style="">
									<thead class="thead-info">
										<tr>
											<th class="row-id-anchor"></th>
<?php if($config['show_id']){ ?>
											<th class="number id"><?= $this->Paginator->sort('id') ?></th>
<?php } ?>
											<th class="string icon-id"><?= $this->Paginator->sort('icon_id') ?></th><!-- H.0. -->
											<th class="string company-id"><?= $this->Paginator->sort('company_id') ?></th><!-- H.0. -->
											<th class="string name"><?= $this->Paginator->sort('name') ?></th><!-- H.1. -->
											<th class="string description"><?= $this->Paginator->sort('description') ?></th><!-- H.1. -->
											<th class="string keywoords"><?= $this->Paginator->sort('keywoords') ?></th><!-- H.1. -->
											<th class="string phone"><?= $this->Paginator->sort('phone') ?></th><!-- H.1. -->
											<th class="string phone2"><?= $this->Paginator->sort('phone2') ?></th><!-- H.1. -->
											<th class="string phone3"><?= $this->Paginator->sort('phone3') ?></th><!-- H.1. -->
											<th class="string phone4"><?= $this->Paginator->sort('phone4') ?></th><!-- H.1. -->
											<th class="string phone5"><?= $this->Paginator->sort('phone5') ?></th><!-- H.1. -->
											<th class="string email"><?= $this->Paginator->sort('email') ?></th><!-- H.1. -->
											<th class="string email2"><?= $this->Paginator->sort('email2') ?></th><!-- H.1. -->
											<th class="string web"><?= $this->Paginator->sort('web') ?></th><!-- H.1. -->
											<th class="string facebook"><?= $this->Paginator->sort('facebook') ?></th><!-- H.1. -->
											<th class="string youtube"><?= $this->Paginator->sort('youtube') ?></th><!-- H.1. -->
											<th class="string logo"><?= $this->Paginator->sort('logo') ?></th><!-- H.1. -->
											<th class="string banner"><?= $this->Paginator->sort('banner') ?></th><!-- H.1. -->
											<th class="string action"><?= $this->Paginator->sort('action') ?></th><!-- H.1. -->
<?php if($config['show_pos']){ ?>
											<th class="number pos"><?= $this->Paginator->sort('pos') ?></th>
<?php } ?>
<?php if($config['show_visible']){ ?>
											<th class="boolean visible"><?= $this->Paginator->sort('visible') ?></th>
<?php } ?>
<?php if($config['show_created'] || $config['show_modified']){ ?>

											<th class="datetime created modified">
												<?php 
													if($config['show_created']){ 
														echo $this->Paginator->sort('created');
													}
													if($config['show_created'] && $config['show_modified']){
														echo "&nbsp;/&nbsp;";
													}
													if($config['show_modified']){
														echo $this->Paginator->sort('modified');
													} ?>

											</th>
<?php } ?>
<?php if($config['show_button_view'] || $config['show_button_edit'] || $config['show_button_delete'] ){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($persons as $person): ?>
<?php
	//$classLastVisited = ' class="last-visited"';	// later...
	//$classLastVisited = '';
?>

										<tr row-id="<?= $person->id ?>"<?php if($person->id == $layoutPersonsLastId){ echo 'class="table-tr-last-id"'; } ?> prefix="<?= $prefix ?>" controller="<?= $controller ?>" action="<?= $action ?>" aria-expanded="true">
											<td class="row-id-anchor" value="<?= $person->id ?>"><a name="<?= $person->id ?>" class="anchor"></a></td>
<?php if($config['show_id']){ ?>
											<td class="number id" value="<?= $person->id ?>"><?= h($person->id) ?><a name="<?= $person->id ?>"></a></td>
<?php } ?>
											<td class="string link icon-id" value="<?= $person->icon_id ?>"><?= $person->hasValue('icon') ? $this->Html->link($person->icon->name, ['controller' => 'Icons', 'action' => 'view', $person->icon->id]) : '' ?><span class="external-link-icon"><i class="fa fa-external-link" aria-hidden="true"></i></span></td>
											<td class="string link company-id" value="<?= $person->company_id ?>"><?= $person->hasValue('company') ? $this->Html->link($person->company->name, ['controller' => 'Companies', 'action' => 'view', $person->company->id]) : '' ?><span class="external-link-icon"><i class="fa fa-external-link" aria-hidden="true"></i></span></td>
											<td class="string name" value="<?= $person->name ?>"><?= h($person->name) ?></td>
											<td class="string description" value="<?= $person->description ?>"><?= h($person->description) ?></td>
											<td class="string keywoords" value="<?= $person->keywoords ?>"><?= h($person->keywoords) ?></td>
											<td class="string phone" value="<?= $person->phone ?>"><?= h($person->phone) ?></td>
											<td class="string phone2" value="<?= $person->phone2 ?>"><?= h($person->phone2) ?></td>
											<td class="string phone3" value="<?= $person->phone3 ?>"><?= h($person->phone3) ?></td>
											<td class="string phone4" value="<?= $person->phone4 ?>"><?= h($person->phone4) ?></td>
											<td class="string phone5" value="<?= $person->phone5 ?>"><?= h($person->phone5) ?></td>
											<td class="string email" value="<?= $person->email ?>"><?= h($person->email) ?></td>
											<td class="string email2" value="<?= $person->email2 ?>"><?= h($person->email2) ?></td>
											<td class="string web" value="<?= $person->web ?>"><?= h($person->web) ?></td>
											<td class="string facebook" value="<?= $person->facebook ?>"><?= h($person->facebook) ?></td>
											<td class="string youtube" value="<?= $person->youtube ?>"><?= h($person->youtube) ?></td>
											<td class="string logo" value="<?= $person->logo ?>"><?= h($person->logo) ?></td>
											<td class="string banner" value="<?= $person->banner ?>"><?= h($person->banner) ?></td>
											<td class="string action" value="<?= $person->action ?>"><?= h($person->action) ?></td>
<?php if($config['show_pos']){ ?>
											<td class="number pos" value="<?= $person->pos ?>"><?= h($person->pos) ?></td>
<?php } ?>
<?php if($config['show_visible']){ ?>
											<td class="boolean visible" value="<?= $person->visible ?>"><?= h($person->visible) ?></td>
<?php } ?>
<?php if($config['show_created'] || $config['show_modified']){ ?>
											<td class="datetime">
<?php if($config['show_created']){ ?>
												<span class="fw-bold"><?= h($person->created) ?></span>
<?php } ?>
<?php if($config['show_created'] && $config['show_modified']){ ?>
												<br>
<?php } ?>
<?php if($config['show_modified']){ ?>
												<span class="fw-normal"><?= h($person->modified) ?></span>
<?php } ?>
											</td>
<?php } ?>
<?php if($config['show_button_view'] || $config['show_button_edit'] || $config['show_button_delete'] ){ ?>

											<td class="actions">
<?php if($config['show_button_view']){ ?>
												<?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $person->id], ['escape' => false, 'role' => 'button', 'class' => 'btn btn-warning btn-sm', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => __('View this item'), 'data-original-title' => __('View this item')]) ?>
<?php } ?>

<?php if($config['show_button_edit']){ ?>
												<?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $person->id], ['escape' => false, 'role' => 'button', 'class' => 'btn btn-primary btn-sm', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => __('Edit this item'), 'data-original-title' => __('Edit this item')]) ?>
<?php } ?>

<?php if($config['show_button_delete']){ ?>
												<?= $this->Form->postLink('', ['action' => 'delete', $person->id], ['class'=>'hide-postlink index-delete-button-class']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($person->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="fa fa-minus"></i></a>

<?php } ?>

											</td>
<?php } ?>
										</tr>
										<?php endforeach; ?>

									</tbody>
								</table>

							</div>
							<div class="card-footer text-center">
								<div class="float-start">
									<?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
								</div>								
								<div class="float-end mb-1">							
									<?= $this->element('jeffAdmin5.paginator') ?>
									
								</div>								
							</div>
						</div><!-- end card-->					
					</div>

				</div>			

	<?php
	if(isset($config['index_show_actions']) && $config['index_show_actions'] && isset($config['index_enable_delete']) && $config['index_enable_delete']){ 
		$this->Html->script(
			[
				"JeffAdmin5./assets/plugins/sweetalert2/dist/sweetalert2.all.min",
				//"JeffAdmin5./assets/plugins/jquery-copy-to-clipboard-master/jquery.copy-to-clipboard",
			],
			['block' => 'scriptBottom']
		);
	}	
	?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']); ?>

	$(document).ready( function(){
		$('tr').dblclick( function(){
			let id = $(this).attr("row-id")
			window.location.href = '<?= $this->Url->build(['controller' => $controller, 'action' => $config['action_db_click']]) ?>/' + id;
		})

		// Fixing CakePhp's paginator numbers
		$('.page-link').each( function(){
			if($(this).text() == '1'){
				$(this).attr('href', $(this).attr('href') + '?page=1');
			}
		});
		
	})
<?php $this->Html->scriptEnd(); ?>



