<html>
    <head>
        <title>
            Create User Page
        </title>
    </head>
    <body>
        <form method="post" action="<?php echo RESOURCE ;?>/user/AddPost" name="Add"  onsubmit="return validateForm()">
            <table>
                <tr>
                    <td>
                        First Name:&nbsp;
                    </td>
                    <td>
                        <input type="text" id="fName" name="fName"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Last Name:&nbsp;
                    </td>
                    <td>
                        <input type="text" id="lName" name="lName"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Email: &nbsp;
                    </td>
                    <td>
                        <input type="text" id="email" name="email"/>
                    </td>
                </tr>
            </table>
                            <input type="button" value="Back" onclick="document.location.href='<?php echo RESOURCE ;?>/user/index'" />
                <input type="submit" value="Add"/>
        </form>
    </body>
</html>
<script type="text/javascript">

function validateForm() {
    var f = document.forms["Add"]["fName"].value;
    var l = document.forms["Add"]["lName"].value;
    var e = document.forms["Add"]["email"].value;
    if (f == null || f == "" && l==null || l=="" && e==null|| e=="") {
        alert("Must Not Leave anything blank");
        return false;
    }
    else{
        
        return true;
        
    }
}

</script>