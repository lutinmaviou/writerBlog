<?php $title = 'Nouveau post';
ob_start();
?>
<section class="container">
    <h2 class="text-center mt-5">Nouveau chapitre</h2>
    <div class="row">
        <form class="col-lg-10 text-center mx-auto bg-light border border-light rounded-lg p-5 mt-4 shadow" action="index.php?action=addNewPost" method="POST">
            <div class="form-row mb-4">
                <div class="mx-auto">
                    <label for="title">
                        <input type="text" id="title" name="title" class="form-control mr-lg-5" placeholder="Titre" required>
                    </label>
                </div>
            </div>
            <label for="chapterContent" class="col-lg-12">
                <textarea name="chapterContent" class="tinyMce" id="chapterContent" rows="10"></textarea>
            </label>
            <small class="form-text text-muted mb-4">
            </small>
            <button class="btn btn-outline-info px-5" type="submit">Envoyer</button>
        </form>
    </div>
</section>
<?php
$content = ob_get_clean();
require('template.php');
?>