<?php 

include("../config.php");

if (isset($_POST['simpan'])) {
  $category_name = $_POST['category_name'];
  $query = "INSERT INTO categories (category_name) VALUES ('$category_name')"; 
  $exec = mysqli_query($conn, $query);
  if ($exec) {
		header('Location: kategori.php?status=added');
  }
}

if(isset($_GET['category_id'])) {
	$category_id = $_GET['category_id'];
	$exec = mysqli_query($conn,"DELETE FROM categories WHERE category_id='$category_id' ");
	if($exec) {
		header('Location: kategori.php?status=deleted');
  }
}

if(isset($_POST['update'])) {
	$category_id = $_POST['category_id'];
	$category_name = $_POST['category_name'];
	$query = "UPDATE categories SET category_name = '$category_name' WHERE category_id='$category_id'";
	$exec = mysqli_query($conn,$query);
	if($exec) {
		header('Location: kategori.php?status=updated');
	}else {
    
	}
}

?>