<?php $title = 'Le blog de Jean Forteroche';
ob_start(); ?>
<div id="book_presentation">
    <h2>Mon dernier roman en ligne</h2>
    <p>Suivez son évolution au fur et à mesure de mon écriture !</p>
    <img src="public/img/Sans titre.png" alt="book">
</div>
<h3>Derniers chapitres</h3>
<?php
while ($data = $req->fetch()) {
    ?>
    <div id="chapters_view">
        <a href="index.php?action=post&amp;id=<?= $data['id']; ?>">
            <h4>
                <?php echo htmlspecialchars(ucfirst($data['title'])); ?>
                <em><span class="date_font"> publié le <?php echo $data['postDateFr']; ?></span></em>
            </h4>
        </a>
        <p>
            <?php
                echo nl2br(htmlspecialchars(ucfirst(substr($data['chapterContent'], 0, 100)))) . " ...";
                ?>
            <br />
            <span class="read_more">Lire la suite</span>
        </p>
    </div>
<?php
}
?>
<a href="views/createPostView.php">Créer un nouveau chapitre</a>
<h5>Pagination</h5>

<?php
for ($i = 1; $i <= $nbPages; $i++) {
    if ($i === $currentPage) {
        echo $i . ' - ';
    } else {
        echo '<a href="index.php?page=' . $i . '">' . $i . '</a> ';
    }
}
echo '<br />' . $currentPage;
echo '<br />' . $nbPosts;
echo '<br />' . $nbPages;



$req->closeCursor();
$content = ob_get_clean();
require('views/template.php');
?>