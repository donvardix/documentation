<?php global $tw; ?>
<br>
<div class="text-center">
    <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=small&width=59&height=20&appId" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-text="<?=$tw['text']; ?>" data-url="<?=$tw['url']; ?>" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</div>
<br>
<?php use models\Members; ?>
<div class="text-center">
    <a class="btn btn-primary" href="/">Back to home</a>

    <br><br>
    <a href="/all-members?page=1">All members (<?=Members::countMembers() ?>)</a>
</div>