
 <?php 

include('load.php');
 include('../inc/bandeau.php');

	 
	$objectErreur = new myClassErreur();
	$objectErreur->afficherErreurs();
 ?>	  
<div class="text-left" href="#page">
<h3>Bandeaux<small> Mes bandeaux</small></h3>
		  
<br>

	<table class="table table-hover">
		<thead>
			<tr> 
				<th class="">titre</th>
				<th class="">Description</th>
				<th class="">image</th>
				<th class="">Auteur</th>
				<th class="">Dernière modification</th>
				<th class="" style="width:140px">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$getBandeau = mysql_query("SELECT * FROM bandeau ORDER BY (date_bandeau) DESC") or die(mysql_error());
			
			$numGetBandeau = mysql_num_rows($getBandeau);
			while ($result=mysql_fetch_array($getBandeau))
			{
				$IDBandeau = $result['id_bandeau'];
				$titreBandeau = $result['titre_bandeau'];
				$descriptionBandeau = $result['description_bandeau'];
				$imageBandeau = $result['image_bandeau'];
				$auteurBandeau=$result['auteur_bandeau'];
				$dateBandeau = $result['date_bandeau'];
				
				$getInfoAuteur=mysql_query("SELECT * FROM admin where id_admin='$auteurBandeau'") or die(mysql_error());
				$resInfoAutheur=mysql_fetch_assoc($getInfoAuteur);
				$informationAuteur= $resInfoAutheur["nom_admin"].' '.$resInfoAutheur["prenom_admin"].' ('.$resInfoAutheur["type_admin"].')';
				
				if (isset($_POST["supprimerbutton".$IDBandeau])) 
				{
					$objectBandeau = new myClassBandeau();
					$objectBandeau->supprimerBandeau ($IDBandeau);
					header("location: AfficherBandeaux.php#bandeau");
				}
		     
			?>
	 

				<form action="AfficherBandeaux.php#bandeau" method="POST" >
					<tr class="active">
						<td class=""><strong><?php echo $titreBandeau; ?></strong></td>
						<td class=""><?php echo $descriptionBandeau; ?></td>
						
						<td class=""> <img src="../uploadBandeau/<?php echo $imageBandeau; ?>" width="160px"  height="100px"> </td>
						<td class=""><?php echo $informationAuteur; ?></td>
						<td class=""><?php echo $dateBandeau; ?></td>
					
						<td class="">
						<img  src="../img/del.png" onclick="$('#sup<?php echo $IDBandeau; ?>').toggle('slow');" style="cursor: pointer;" />
						</td>
					</tr>
				 
					<tr class="danger" id="sup<?php echo $IDBandeau; ?>" style="display: none;">
						<td colspan="5"> Vous êtes sur de vouloir supprimer cette page ?</td>
						<td><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDBandeau; ?>" >Oui, je supprime !</button> </td>
					</tr>
				</form>

			<?php }?>
			
							

		</tbody>
	</table>
</div>
         
  <?php include('footer.php'); ?>      