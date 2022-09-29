<html>
  <head>
    <title>Civa S.A.</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- playground-hide -->
    <script>
      const process = { env: {} };
      process.env.GOOGLE_MAPS_API_KEY =
        "AIzaSyCrf-Ws5b0KASHz0kQho34CHyS_Vhq_B7c";
    </script>
    <!-- playground-hide-end -->

    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrf-Ws5b0KASHz0kQho34CHyS_Vhq_B7c&callback=fn_ok"></script>
    <!--Llamando al algoritmo HillClimbing-->
    <?php
        $command = escapeshellcmd('py C:\xampp\htdocs\proyectoIA-HillClimbing-Manual\hillclimbing.py'); 
        $output = shell_exec($command); 

        //Separando Ruta de Distancia
        $separada = explode("]", $output);

        //Separando nodos de Ruta
        $nodos = explode(",", $separada[0]);

        //Limpiando caracteres de nodos
        function RemoveSpecialChar($str){
            $res = preg_replace('/[[\@\.\;\']+/', '', $str);
            return $res;
        }
        for($i=0;$i<count($nodos);$i++){
          $nodos[$i]=RemoveSpecialChar($nodos[$i]);
        }
        
      ?>       
  </head>
  <body>
    <div id="container">
      <div id="map"></div>
      <div id="sidebar" class="contentSidebar">
        
        <div class="algoritmo">
        <h2 class="titulo-algoritmo">Recorrido - Algoritmo Hill Climbing</h2>
            <?php $cont=0;$fin=count($nodos);foreach($nodos as $nodo):?>
              <tr>
                <?php 
                  $cont++;
                  if($cont==1){
                  ?>
                  <b>Agencia de Inicio:</b>
                  <td id="start" value="<?=$nodo?>"><?=$nodo?></td><br />
                  <?php
                    continue;
                  }
                ?>
                <?php
                  if($cont==$fin){
                  ?>
                  <b>Agencia Final:</b>
                  <td id="end" value="<?=$nodo?>"><?=$nodo?></td>
                  <?php
                  break;
                  }
                ?>
                <td><?=$nodo?></td><br />
              </tr>
            <?php endforeach;?>
                  <br>
          <b>Distancia recorrida:</b>
          <p><?=$separada[1]?></p>
        </div>
          
          <h1 class="titulo">CIVA TRANPORTES</h1>
          <div class="agencia-inicio">
            <h2 class="subtitulo">Agencia de Inicio:</h2>
            <select class="select" id="start">
              <?php $cont=0;$fin=count($nodos);foreach($nodos as $nodo):?>
                <tr>
                  <?php 
                    $cont++;
                    if($cont==1){
                    ?>
                    <option value="<?=$nodo?>" selected><?=$nodo?></option>
                    <?php
                      continue;
                    }
                  ?>
                  <option value="<?=$nodo?>"><?=$nodo?></option>
                </tr>
              <?php endforeach;?> 
            </select>
          </div>

          <div class="parent">
            <select multiple class="select-multiple"  id="waypoints">
              <?php $cont=0;$fin=count($nodos);foreach($nodos as $nodo):?>
                <tr>
                  <?php 
                    $cont++;
                    if($cont==1 || $cont==$fin){
                    ?>
                    <?php
                      continue;
                    }
                  ?>
                  <option value="<?=$nodo?>" selected><?=$nodo?></option>
                </tr>
              <?php endforeach;?>
            </select>
          </div>

          <div class="agencia-destino">
            <h2 class="subtitulo">Agencia de Destino:</h2>
            <select class="select"  id="end">
              <?php $cont=0;$fin=count($nodos);foreach($nodos as $nodo):?>
                <tr>
                  <?php 
                    $cont++;
                    if($cont==$fin){
                    ?>
                    <option value="<?=$nodo?>" selected><?=$nodo?></option>
                    <?php
                      continue;
                    }
                  ?>
                  <option value="<?=$nodo?>"><?=$nodo?></option>
                </tr>
              <?php endforeach;?> 
            </select>
          </div>

          <div class="button">
            <input type="submit" id="submit"/>
            <!-- <button id="submit">Enviar</button> -->
          </div>

          <div id="directions-panel"></div>
      </div>
    </div>

    <!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->

    <script src="index.js" type="text/javascript" charset="utf-8"></script>             
    </body>
</html>
