<div>
    <h1 style="text-align: center;">Start Here Header!!!</h1>
</div>

<div style="float: right;">
    <?php echo $this->Html->link('Home',array('controller'=>'users','action'=>'index'),array('style'=>'color:black;font-weight: bold')); ?>  |
    
     <?php
     if($this->Session->read('Auth.User'))
     {
         echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout'),array('style'=>'color:black;font-weight: bold'));
     }
     else
     {
	echo $this->Html->link('Registration',array('controller'=>'users','action'=>'registration'),array('style'=>'color:black;font-weight: bold')).' | '; 
	echo $this->Html->link('Login',array('controller'=>'users','action'=>'login'),array('style'=>'color:black;font-weight: bold'));
     }
     
     ?> 
</div>