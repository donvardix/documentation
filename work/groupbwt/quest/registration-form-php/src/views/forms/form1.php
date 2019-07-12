<form id="form1" action="" method="post">
    <div class="form-group">
        <label>First name<span class="text-danger">*</span></label>
        <input id="firstname" name="firstname" class="form-control" type="text" placeholder="Enter First name" required>
    </div>
    <div class="form-group">
        <label>Last name<span class="text-danger">*</span></label>
        <input id="lastname" name="lastname" class="form-control" type="text" placeholder="Enter Last name" required>
    </div>
    <div class="form-group">
        <label>Birth date<span class="text-danger">*</span></label>
        <input  id="birthdate" name="birthdate" class="form-control" type="date" value="" required>
    </div>
    <div class="form-group">
        <label>Report subject<span class="text-danger">*</span></label>
        <input id="reportsubject" name="reportsubject" class="form-control" type="text" placeholder="Enter Report subject" required>
    </div>
    <div class="form-group">
        <label>Country<span class="text-danger">*</span></label>
        <select id="country" name="country" class="custom-select required" required>
            <?php use models\Members; ?>
            <?php $countries = Members::countries(); ?>
            <option value="">Select country</option>
            <?php foreach($countries as $country): ?>
                <option value="<?=$country->country?>"><?=$country->country?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Phone<span class="text-danger">*</span></label>
        <input name="phone" id="phone" class="form-control" placeholder="Enter Phone">
        <input hidden type="checkbox" id="phone_mask" checked>
        <input hidden type="radio" name="mode" id="is_world" value="world" checked>
        <input hidden type="radio" name="mode" id="is_russia" value="ru">
    </div>
    <div class="form-group">
        <label>Email<span class="text-danger">*</span></label>
        <input id="email" name="email" class="form-control" type="email" placeholder="Enter Email" required>
        <label id="emaild"></label>
    </div>

    <div id="res"></div>
    <div class="text-right"><button id="send-form1" type="submit" class="btn btn-primary pull-right">Next</button></div>
</form>
<br>
<div class="text-center">
    <a href="/all-members?page=1">All members (<?=Members::countMembers() ?>)</a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/RobinHerbots/Inputmask/3.2.7/dist/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<script src="https://cdn.rawgit.com/andr-04/inputmask-multi/1.2.0/js/jquery.inputmask-multi.min.js" type="text/javascript"></script>
<script src="src/resources/javascript/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="src/resources/javascript/form1.js"></script>
