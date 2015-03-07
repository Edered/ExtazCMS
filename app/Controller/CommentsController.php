<?php
Class CommentsController extends AppController{
	
	public function write(){
		if($this->Auth->user()){
			if($this->request->is('post')){
				$post_id = $this->request->data['Comments']['post_id'];
				$author = $this->Auth->user('username');
				$ip = $_SERVER['REMOTE_ADDR'];
				$comment = $this->request->data['Comments']['comment'];
				if(!empty($comment)){
					$this->Comment->create;
					$this->Comment->saveField('post_id', $post_id);
					$this->Comment->saveField('author', $author);
					$this->Comment->saveField('ip', $ip);
					$this->Comment->saveField('comment', $comment);
					$this->Session->setFlash('Votre commentaire a été ajouté !', 'success');
					return $this->redirect($this->referer());
				}
				else{
					$this->Session->setFlash('Vous devez écrire un message', 'info');
					return $this->redirect($this->referer());
				}
			}
		}
	}

	public function delete($id = null){
		if($this->Auth->user('role') > 0){
			$this->Comment->delete($id);
			$this->Session->setFlash('Commentaire supprimé', 'success');
			return $this->redirect($this->referer());
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_delete($id = null){
		if($this->Auth->user('role') > 0){
			$this->Comment->delete($id);
			$this->Session->setFlash('Commentaire supprimé', 'success');
			return $this->redirect(['controller' => 'comments', 'action' => 'list', 'admin' => true]);
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_edit($id = null){
        if($this->Auth->user('role') > 0){
            $this->Comment->id = $id;
            if($this->Comment->exists()){
                $this->set('data', $this->Comment->find('first', ['conditions' => ['Comment.id' => $id]]));
                if($this->request->is('post')){
                    $this->Comment->id = $id;
                    $this->Comment->saveField('comment', $this->request->data['Comments']['comment']);
                    $this->Session->setFlash('Le commentaire a bien été modifié', 'success');
                	return $this->redirect($this->referer());
                }
            }
            else{
                $this->Session->setFlash('Ce commentaire n\'existe pas !', 'error');
                return $this->redirect($this->referer());
            }
        }
        else{
			throw new NotFoundException();
		}
    }

    public function admin_list(){
    	if($this->Auth->user('role') > 0){
    		$this->set('data', $this->Comment->find('all', ['order' => ['Comment.id' => 'DESC']]));
        }
        else{
			throw new NotFoundException();
		}
    }
}