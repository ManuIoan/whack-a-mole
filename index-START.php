<?php
include_once "conn.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Whack A Mole!</title>
  <link href='https://fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="style6.css">
</head>
<body>

<div class="bca">
  <h1 class="hml">Whack-a-mole! <span class="score">0</span></h1>
  

  <div class="game">
    <div class="hole hole1">
      <div class="mole"></div>
    </div>
    <div class="hole hole2">
      <div class="mole"></div>
    </div>
    <div class="hole hole3">
      <div class="mole"></div>
    </div>
    <div class="hole hole4">
      <div class="mole"></div>
    </div>
    <div class="hole hole5">
      <div class="mole"></div>
    </div>
    <div class="hole hole6">
      <div class="mole"></div>
    </div>
    <div class="hole hole7">
      <div class="mole"></div>
    </div>
    <div class="hole hole8">
      <div class="mole"></div>
    </div>
    <div class="hole hole9">
      <div class="mole"></div>
    </div>
    <div class="air">
    <form action="" method="POST" class="frm">
      <label for="" class="fs3">Numele tau:</label>
      <input type="text" class="spg" name="" id="">
       <input type="button" class="btn" onclick="sterge()" value="GO!" >
    </form>
    </div>
    



    
  </div>
  <div class="scor">
    <div class="tisc">
      SCOREBOARD
    </div>
      <?php
      
      $sql = mysqli_query($conn, "SELECT * FROM score ORDER by score DESC ");
      $i = 1;
      while($row = mysqli_fetch_assoc($sql) )
      if($i<=10)
        {



         $io  = $row['score'];
         $ios = intval($io);
         echo "<div class='cioc'>
         
         <div class='cs'>
         {$i}.
         </div>
         <div class='cio'>
         {$row['nume']}
         </div>
           
          
           
           <div class='ci'>
           {$ios}
         </div>
         </div>";
         $i++;
        }
       while($i<=10)
       {
         
        echo "<div class='cioc'>
         
        <div class='cs'>
        {$i}.
        </div>
        <div class='cio'>
            .....
        </div>
          
         
          
          <div class='ci'>
          .....
        </div>
        </div>";
        $i++;
       }

      
      ?>
    </div>
  <link rel="stylesheet" href="style6.css">

<script>
  const holes = document.querySelectorAll('.hole');
  const scoreBoard = document.querySelector('.score');
  const moles = document.querySelectorAll('.mole');
  let lastHole;
  let timeUp = false;
  let score = 0

  function randomTime(min,max) {
    return Math.round(Math.random() * (max - min) + min);
  }
  let ast; 
  function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}
  function randomHole(holes) {
    const idx = Math.floor(Math.random() * holes.length);
    const hole = holes[idx];
    if(hole === lastHole) {
      console.log("msg");
      return randomHole(holes);
    }

    lastHole = hole;
    ast = getRandomInt(5)%5;
   
    return hole;
  }


  function bonk(e) {
    if(!e.isTrusted)return; //cheater!
    score++;
    this.classList.remove("up");
    scoreBoard.textContent = score;
  }

  function peep() {
    const time = randomTime(200,1000);
    const hole = randomHole(holes);
    console.log(hole);
    
    let asta = "m"+ast; 
    
    hole.classList.add("up");
    hole.innerHTML = `<div class='mole ${asta}'></div>`
    const moles = document.querySelectorAll('.mole');
      moles.forEach(mole => mole.addEventListener("click", bonk));
    setTimeout(() => {
      
      hole.classList.remove("up");
      hole.innerHTML = `<div class='mole'></div>`
      if(!timeUp)peep();
    }, time);
  }
  pr = document.querySelector('.air');
  str = document.querySelector('.frm');
  let spg = document.querySelector('.spg')
  let nume="";
 console.log(spg);
  const sterge = () =>{
     str.innerHTML='<div class="all"><button onClick="startGame()">Start!</button></div>';
      nume = spg.value;
      console.log(nume);
  }


  function startGame() {
    pr.innerHTML='';
    scoreBoard.textContent = 0;
    timeUp = false;
    score = 0;
    peep();
    setTimeout(() => {
      timeUp = true
      
      pr.innerHTML= '<form action="" method="POST" class="frm"><label for="" class="fs3">Numele tau:</label><input type="text"  name="" id=""><input type="button" class="btn" onclick="sterge()" value="GO!" ></form>'
      pr = document.querySelector('.air');
      str = document.querySelector('.frm');

      let xhr = new XMLHttpRequest();
    //creating XML object
    xhr.open("POST", "scor.php", true);
    xhr.onload = ()=>{
       if(xhr.readyState === XMLHttpRequest.DONE)
       {
           if(xhr.status === 200){
               
               let data = xhr.response;
               if(data=="succes")
               {   
                history.go(0);
               }
               console.log(data);
                
              
               
               
               
           }
       }
    }


    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("scr="+score+"&nume="+nume);


    }, 100000);
  }

  

  moles.forEach(mole => mole.addEventListener("click", bonk));
   
  
 


</script>


</div>






</html>