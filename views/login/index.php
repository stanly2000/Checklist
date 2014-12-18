<?php 
?>
<h2> Login </h2>
<div class="row">
    
    <div class="col-md-8">
        
        <section id="loginform">
            
            <form action="index.php" class="form-horizontal" method="post" role="form"   >
                <div class="form-group">
                    <label class="col-md-2 control-label" for="Email">Email:</label>
                    <div class="col-md-10">
                        <input class="form-control" data-val="true" data-val-required="The email field is required." id="Email" name="Email" type="text" value=""/>
                        <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-md-2 control-label" for="Password">Password:</label>
                    <div class="col-md-10">
                        <input class="form-control" data-val="true" data-val-required="The password field is required." id="Email" name="Password" type="password" />
                        <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" value="Log In" class="btn btn-default" />
                    </div>
                </div>
            </form>              
        </section>
    </div>
</div>
    

