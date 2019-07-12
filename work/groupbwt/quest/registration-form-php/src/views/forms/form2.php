<form id="form2" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Company</label>
        <input id="company" name="company" class="form-control" type="text" placeholder="Enter company">
    </div>
    <div class="form-group">
        <label>Position</label>
        <input  id="position" name="position" class="form-control" type="text" placeholder="Enter position">
    </div>
    <div class="form-group">
        <label>About me</label>
        <textarea id="aboutme" name="aboutme" class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label>Photo</label>
        <input id="photo" name="photo" class="form-control-file" type="file">
        <div><span id="res" class="text-danger"></span></div>
    </div>

    <div class="text-right"><button id="send-form2" type="submit" class="btn btn-primary pull-right">Next</button></div>
</form>
<br>
<?php use models\Members; ?>
<div class="text-center">
    <a href="/all-members?page=1">All members (<?=Members::countMembers() ?>)</a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="src/resources/javascript/form2.js"></script>
