<?php $this->assign('title', 'Liste des mondes'); ?>
<script>
$(document).ready(function(){
    $(window).load(function(){
        $(".confirm").confirm({
            text: "Voulez vous vraiment bannir ce joueur ?",
            title: "Confirmation",
            confirmButton: "Oui",
            cancelButton: "Non"
        });
    });

    $('#data-table').dataTable({
        "lengthMenu": [[25, 30, 35, -1], [25, 30, 35, "Tout"]],
        "order": [[1, 'DESC']],
        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucune donnée disponible dans le tableau",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }
    });
});
</script>
<?php
$players = $api->call('worlds.all')[0]['success'];
$count = count($players);
//debug($players);
?>
<div class="main-content">
    <div class="container">
        <div class="page-content">
            <div class="single-head">
                <h3 class="pull-left"><i class="fa fa-table lblue"></i><?php echo $count; ?> mondes sur le serveur</h3>
                <div class="clearfix"></div>
            </div>
            <div class="page-tables">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th><b>Nom</b></th>
                                <th><b>Type</b></th>
                                <th colspan="2"><b>PVP</b></th>
                                <th colspan="4"><b>Difficulté</b></th>
                                <th><b>Joueurs</b></th>
                                <th><b>Seed</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
							foreach($players as $p){
								?>
								<tr>
	                                <td>
										<?php
	                                		echo $p['name'];
	                                	?>
	                                </td>
	                                <td><?php echo $p['environment']; ?></td>
	                                <td>
	                                	<?php
	                                	if($p['isPVP'] == true){
	                                		echo $this->Html->image('minecraft/pvp.png', ['width' => 16, 'height' => 16, 'class' => 'ui-tooltip', 'data-original-title' => 'PvP activé', ' data-toggle' => 'tooltip', 'data-placement' => 'left']);
	                                	}
	                                	else{
	                                		echo $this->Html->image('minecraft/nopvp.png', ['width' => 16, 'height' => 16, 'class' => 'ui-tooltip', 'data-original-title' => 'PvP désactivé', ' data-toggle' => 'tooltip', 'data-placement' => 'left']);
	                                	}
	                                	?>
	                                </td>
                                    <td>
                                         <?php
                                            if($p['isPVP'] == true)
                                                {?>
                                                    <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'pvpoff', $p['name']]); ?>" class="label label-danger"></i> PVP ON</a>
                                          <?php }
                                            else
                                                {?>
                                                   <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'pvpon', $p['name']]); ?>" class="label label-black"></i> PVP OFF</a> 
                                          <?php }
                                        ?>
                                    </td>
	                                <td>
	                                	 <?php
                                            if($p['difficulty'] == 0)
                                                {?>
                                                    <a class="label label-success"></i> Peaceful</a>
                                          <?php }
                                            else
                                                {?>
                                                   <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'peaceful', $p['name']]); ?>" class="label label-black"></i> Peaceful</a> 
                                          <?php }
                                        ?>
	                                </td>
                                    <td>
                                        <?php
                                            if($p['difficulty'] == 1)
                                                {?>
                                                    <a class="label label-success"></i> Easy</a>
                                          <?php }
                                            else
                                                {?>
                                                   <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'easy', $p['name']]); ?>" class="label label-black"></i> Easy</a> 
                                          <?php }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($p['difficulty'] == 2)
                                                {?>
                                                    <a class="label label-success"></i> Normal</a>
                                          <?php }
                                            else
                                                {?>
                                                   <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'normal', $p['name']]); ?>" class="label label-black"></i> Normal</a> 
                                          <?php }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($p['difficulty'] == 3)
                                                {?>
                                                    <a class="label label-success"></i> Hard</a>
                                          <?php }
                                            else
                                                {?>
                                                   <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'hard', $p['name']]); ?>" class="label label-black"></i> Hard</a> 
                                          <?php }
                                        ?>
                                    </td>
	                                <td>
                                        <?php 
                                            $count1 = count($p['players']);
                                            echo $count1;
                                        ?>
                                    </td>
                                    <td><?php echo $p['seed']; ?></td>
	                            </tr>
								<?php
								 //debug($p);
							}
							?>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>