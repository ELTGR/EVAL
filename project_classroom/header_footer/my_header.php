<header>    

<?php
$value_page = isset($_GET['page']) ? $_GET['page']: FALSE ;
?>

<form action="/index.php" method="get">
    <input type="hidden" name="page" value="<?php echo $value_page-1 ?>" />
    <input type="submit" class ="my_button" value="Back"/>
</form>

<div class="header-text_index">
    <h1>C'est nous, c'est les SN</h1>
</div>
<form action="/index.php" method="get">
    <input type="hidden" name="page" value="<?php echo $value_page+1 ?>" />
    <input type="submit" class ="my_button" value="Next"/>
</form>
</header>