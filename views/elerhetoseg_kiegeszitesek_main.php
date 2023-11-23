<!DOCTYPE HTML>
<html>
  <head>
  <meta charset="utf-8">
  <script type="text/javascript" src = "../includes/jquery.min.js"></script>
  <script type="text/javascript" src = "../includes/kiolvas.js"></script>
  <title>Városok</title>
  <style>
    #informaciosdiv {
      width: 400px;
    }
    #intezmenyinfo {
      float: right;
      border: 1px solid black;
      width: 190px;
      height: 100px;
    }
    .cimke{
      display: inline-block;
      width: 60px;
      text-align: right;
    }
    span {
      margin: 3px 5px;
    }
    label {
      display: inline-block;
      width: 70px;
      text-align: right;
    }
    select {
      width: 115px;
    }
  </style>
  </head>
  <body>
    <h1>Város adatai:</h1>
    <div id = 'informaciosdiv'>
      <div id = 'intezmenyinfo'>
        <span class="cimke">Év:</span><span id="ev" class="adat"></span><br>
        <span class="cimke">Nő:</span><span id="no" class="adat"></span><br>
        <span class="cimke">Összesen:</span><span id="osszesen" class="adat"></span><br>
       
      </div>
      <label for='mecimke'>Megye:</label>
      <select id = 'meselect'></select>
      <br><br>
      <label for = 'vkcimke'>Város:</label>
      <select id = 'vkselect'></select>
      <br><br>
      <label for = 'evcimke'>Évszám:</label>
      <select id = 'evselect'></select>
    </div>
  </body>
  </html>