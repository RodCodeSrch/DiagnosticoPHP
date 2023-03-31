

<script type="text/javascript" >
  var DataBaseUrl = "<?=BASE_URL?>";
</script>
  
<script type="text/javascript" src="<?=BASE_URL?>assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?=BASE_URL.$dataJS['Data_JS'] ?>"></script>

<?php 
/**
 * espacio de código que se muestra cuando existe parámetro para la actualización 
 */
    if(isset($_GET['codopt'])){
      echo ' <script>';
      echo "let Refdata = ".$_GET['codopt'].';';
      echo 'getdatabycod(Refdata)';
      echo '</script>';
    }?>    
</body>
</html>