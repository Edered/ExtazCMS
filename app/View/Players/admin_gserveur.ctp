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
                <h3 class="pull-left"><i class="fa fa-table lblue"></i><?php echo $count; ?> mondes</h3>
                <div class="clearfix"></div>
            </div>
            <div class="page-tables">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th><b>Nom</b></th>
                                <th><b>Joueurs</b></th>                               
                                <th><b>Heure</b></th>
                                <th><b>Pluie</b></th>
                                <th><b>Orage</b></th>
                                <th><b>Foudre</b></th>
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
                                    <td>
                                        <?php 
                                            $count1 = count($p['players']);
                                            echo $count1;
                                        ?>
                                    </td>
                                    <td><?php echo date('H:i', $p['fullTime']); ?></td>
                                    <td>
                                         <?php
                                            if($p['remainingWeatherTicks'] == 0)
                                                {?>
                                                    <a href="<?php //echo $this->Html->url(['controller' => 'players', 'action' => 'pluieoff', $p['name']]); ?>" class="label label-black"></i> Pluie OFF</a>
                                          <?php }
                                            else
                                                {?>
                                                   <a href="<?php //echo $this->Html->url(['controller' => 'players', 'action' => 'pluieon', $p['name']]); ?>" class="label label-danger"></i> Pluie ON</a> 
                                          <?php }
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                            if($p['hasStorm'] == true)
                                                {?>
                                                    <a href="<?php //echo $this->Html->url(['controller' => 'players', 'action' => 'pvpoff', $p['name']]); ?>" class="label label-black"></i> Orage OFF</a>
                                          <?php }
                                            else
                                                {?>
                                                   <a href="<?php //echo $this->Html->url(['controller' => 'players', 'action' => 'pvpon', $p['name']]); ?>" class="label label-danger"></i> Orage ON</a> 
                                          <?php }
                                        ?>
                                    </td>
                                    <td>
                                         <?php
                                            if($p['isThundering'] == true)
                                                {?>
                                                    <a href="<?php //echo $this->Html->url(['controller' => 'players', 'action' => 'pvpoff', $p['name']]); ?>" class="label label-black"></i> Foudre OFF</a>
                                          <?php }
                                            else
                                                {?>
                                                   <a href="<?php //echo $this->Html->url(['controller' => 'players', 'action' => 'pvpon', $p['name']]); ?>" class="label label-danger"></i> Foudre ON</a> 
                                          <?php }
                                        ?>
                                    </td>
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