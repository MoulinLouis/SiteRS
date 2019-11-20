<?php
include("app/functions.php");

include("app/postevent_management.php");
$result = new postevent_management();
$posts = $result->getEvents();
session_start();
?>

<?php require_once("app/functions.php"); ?>
<?php require_once("app/include/header.php"); ?>
<?php require_once("app/include/navbar.php"); ?>

<?php showMessage(); ?>

	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="lib/img/1.png">
		<div class="container">
			<div class="hero-text text-white">
				<h2>Lycée Robert Schuman</h2>
				<h6>Un site d'ancien élève</h6>
			</div>

		</div>
	</section>
	<!-- Hero section end -->

	<!-- categories section -->
	<section class="categories-section spad">
		<div class="container">
			<div class="section-title">

                <h2 style="color: black">Notre établissement</h2>
				<p>L’établissement a été créé en 1920 par quelques ingénieurs centraliens chrétiens qui fondèrent une association pour alphabétiser des jeunes gens en difficultés : c’était la naissance de « l’Entraide Éducative ». Plus tard, s’ajouteront différentes formations professionnelles pour devenir le Lycée privé Robert Schuman (Sous contrat d’association avec l’État).</p>
			</div>
				<p><u>Aujourd’hui le lycée Robert SCHUMAN propose des formations diverses :</u></p>
			<ul>
				<li>3e Prépa-Pro (Découverte Professionnelle)</li>
				<li>Bac Professionnel 3 ans Technicien d’Usinage</li>
				<li>Bac Professionnel 3 ans Maintenance des Equipements Industriels (MEI)</li>
				<li>Bac Professionnel 3 ans Systèmes Electroniques Numériques (SEN)</li>
				<li>Option Télécommunications et réseaux informatiques</li>
				<li>Bac Technologique STI2D options SIN et ITEC</li>
				<li>BTS Services Informatiques aux Organisations (SIO) (Alternance uniquement la 2ème année)</li>
				<li>BTS Conception des Processus de Réalisation de Produits (CPRP) (Ouverture rentrée 2016) (Contrat de professionnalisation sur les 2 ans)</li>
			</ul>
			<br>
			<p>Soit actuellement 300 élèves, guidés par une équipe exigeante dont l’objectif est  non seulement de donner une formation professionnelle et une formation générale, mais aussi une formation humaine fondée sur la ponctualité, l’assiduité, la rigueur, le respect de soi et des autres ainsi que le sens de l’effort.</p>
			<br>
			<center>
				<h2 id="evenements">Nos évènements</h2>

			</center>
			<br>
			<h1></h1>
			<div class="row">
                <?php foreach($posts as $post) { ?>
                <!-- categorie -->
				<div class="col-lg-4 col-md-6 event">
					<div class="categorie-item">
						<div class="ci-text">
							<h5 class="black"><?php echo $post['titre']; ?></h5>
							<p><?php echo $post['texte']; ?></p>
							<span>Posté le <?php echo $post['date']; ?></span>
						</div>
					</div>
				</div>
                <?php } ?>
            </div>
		</div>
	</section>
	<!-- categories section end -->











	<!-- banner section -->
	<section class="banner-section spad">
		<div class="container">
			<div class="section-title mb-0 pb-2">
				<h2 style="color: black">Nous rejoindre</h2>
				<p>Si toi aussi tu es un ancien étudiant du populaire lycée Robert Schuman, inscris toi !</p>
			</div>
			<div class="text-center pt-5">
				<a href="inscription.php" class="site-btn">S'inscrire</a>
			</div>
		</div>
	</section>
	<!-- banner section end -->
</body>


<?php require_once("app/include/footer.php"); ?>
<script type="text/javascript">

</script>

</html>