<!-- Pagination start -->
<div class="paging right">
    
    <?php $this->Paginator->options(array('query' =>  $this->request->query)); ?>
    
    <?php echo $this->Paginator->prev();?>
    
    <?php echo $this->Paginator->numbers(array('class'=>'number',"separator"=>false)); ?>
    
    <?php echo $this->Paginator->next();?>
    
</div>
<!-- Pagination end -->