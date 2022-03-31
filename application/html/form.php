<?php

?>
<form action='index.php?action={parm4}DB' name='myForm' method='post'>
    <div class='form-group'>
        <input class='form-control' name='id' id='id' type='hidden' value='{parm0}' />
    </div>
    <?php
	print_r(array_keys($parms));
	?>
    <div class="form-group">
        <label for="couleur">Prénom</label>
        <input type="text" class="form-control" id="prénom" name="prénom" value="{parm1}" required />
    </div>
    <div class="form-group">
        <label for="couleur">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="{parm2}" required />
    </div>
    <div class="form-group">
        <label for="couleur">Email</label>
        <input type="text" class="form-control" id="email" name="email" value="{parm3}" />
    </div>

    <div class="btn-group btn-group-justified">
        <button class="btn btn-primary" style="margin-right: 0.5rem">
            {parm4}
        </button>
        <a href="index.php" class="btn btn-danger">back</a>
    </div>
</form>