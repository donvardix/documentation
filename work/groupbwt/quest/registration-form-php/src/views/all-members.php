<?php
require_once __DIR__ . "/layouts/top.php";
//use models\Members;
?>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">Home</a>
    </nav>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col">Report subject</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
        <?php $members=models\Members::allMembers(); ?>
        <?php foreach($members as $member): ?>
            <tr>
                <th scope="row"><img src="<?=$member->photo ?>" width="50" height="50" alt="photo"></th>
                <td><?=$member->firstname ?> <?=$member->lastname ?></td>
                <td><?=$member->reportsubject ?></td>
                <td><a href="mailto:<?=$member->email ?>"><?=$member->email ?></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


    <nav>
        <ul class="pagination justify-content-center">

            <?php $members=models\Members::pagination(); ?>
            <?php for($page = 1; $page <= $members['total_pages']; $page++): ?>

                <?php if($page==$members['getPage']): ?>
                    <li class="page-item active"><a class="page-link" href="?page=<?=$page ?>"><?=$page ?></a></li>

                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="?page=<?=$page ?>"><?=$page ?></a></li>
                <?php endif ?>



            <?php endfor ?>
        </ul>
    </nav>

</div>
</body>
</html>