<form role="form" method='post' action='<?php echo base_url(); ?>index.php/AdminPanel/addmocktestsubmit'>
    <div class="box-body" style='width:50%;margin:auto;'>
        <div class="form-group">
          <label for="exampleInputEmail1">Mock Test Name</label>
          <input type="text" class="form-control" name="test_name" placeholder="Enter Mock Test Name" required>
        </div>
		<div class="form-group">
          <label for="exampleInputEmail1">Mock Test Category</label>
          <select class="form-control" name="category" required>
			<option value='academic'>Academic</option>
			<option value='general'>General</option>
		  </select>		  
        </div>
		<div class="form-group" >
		 <button type="submit" class="btn btn-primary">Submit</button>			
		</div>
    </div>        
       
</form>