<?php $this->assign('title', 'Chat du serveur'); ?>
<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
<style>

.console {
    width: 700px;
    height: 400px;
    background-color:black;
    color:#FFF;
    font-family: 'Open Sans';
    font-size:11px;
    overflow: auto;
    font-weight:bold;
}
.sendcommand{
    width: 700px;
    padding:5px;
    background-color:black;
    color:#BBB;
    border:none;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click', '.player', function(){
    	var message = $('#message').val();
    	$('#message').val('@' + this.id + ' ' + message).focus();
    });
	
    setInterval(function(){
    	if($('.update').is(":checked")){
	    	var url_chat_messages = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'chat_messages')); ?>';
	    	var url_chat_update = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'chat_update')); ?>';
	        $.get(url_chat_messages, function(data){
				$('.chat-messages').html(data);
			}, 'json');
			$.get(url_chat_update, function(data){
				$('.chat-update').html(data);
			}, 'json');
		}
    }, 5000);

    $('.send-message').on('click', function(){
    	event.preventDefault();
        var message = $('#message').val();
        var url = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'send_message')); ?>';
        $.post(url, {message: message}, function(data){
        	$('#message').val('');
        	var url = '<?php echo $this->Html->url(array('controller' => 'pages', 'action' => 'chat_messages')); ?>';
	        $.get(url, function(data){
				$('.chat-messages').html(data);
			}, 'json');
        	$.bootstrapGrowl("<i class='fa fa-check'></i> Message envoyé !", {
			  ele: 'body',
			  type: 'success',
			  offset: {from: 'top', amount: 20},
			  align: 'center',
			  width: 'integer',
			  delay: 2000,
			  allow_dismiss: false,
			  stackup_spacing: 10
			});
        });
    });
});
</script>
<div class="page-content">
<table>
	<thead>
    	<tr>
    		<th><b><center>Console</center></b></th>
    	</tr>
    </thead>
    <tbody>
    	<tr>
    		<td>
    			<div class="console">
					<?php
						$console = $api->call('streams.console.latest', [$chat_nb_messages])[0]['success'];
						$console = array_reverse($console);
						//$replace = array('<span style="color: purple;">INFO</span>]', '<span style="color: orange;">WARN</span>]', '<span style="color: red;">SEVERE</span>]');
						//$length = array(4, 4, 4);
						//$time = $console['time'];
						//debug($time);
						//echo $console['success']['time'];

							if(count($console) >= $chat_nb_messages)
								{
									foreach($console as $c)
										{
											echo $c['line'].'</b><br>';
										//$console = array('[08:23:12 INFO]', '[08:40:12 WARNING]', '[08:50:12 SEVERE]');
										//	$test = implode('; ', $c)."</b><br>";
											//debug($test);
										}
								}	
							else
								{
									//echo '<div class="alert alert-warning alert-dismissable"><small>Désolé mais il n\'y a pas assez de messages pour afficher la console (minimum 20)</small></div>';
								}
						
					?>
				</div>
				<div class="sendcommand">
					<form>
						<div class="input-group">
							<?php 
								echo $this->Form->input('message', ['type' => 'text', 'class' => 'form-control', 'placeholder' => 'Envoyer un message', 'required' => 'required', 'label' => false]); 
							?>
							<span class="input-group-btn">
								<button class="btn btn-default send-message" type="submit"><i class="fa fa-chevron-right"></i></button>
							</span>
			            </div>
			        </form>
		        </div>
    		</td>
    	</tr>
    </tbody>
</table>