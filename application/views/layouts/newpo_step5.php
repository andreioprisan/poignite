<div class="page-header">
<br><h1>Purchase Order Request <small>#<?= substr($_SESSION['currentpo']['step4']['pouniqueid'], 0, 6); ?> by <?= $_SESSION['currentpo']['step1']['author_email'] ?></small></h1><br/>
</div>
<br>
<form class="form-horizontal" action="/po/savepo" method="post" enctype="multipart/form-data">

