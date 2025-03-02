<?php include_once 'header.php' ?>
<style>
  .main-container {
    width: 100%;
    height: 80%;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.15);
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    font-family: 'Roboto Mono';
  }
  body {
    background: linear-gradient(135deg, #cce8ff, #b3ddff, #99d2ff);
    background-size: 300% 300%;
    animation: gradient-bg 8s infinite;
  }

  /* Gradient Animation */
  @keyframes gradient-bg {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
</style>
<div class="container body-content d-flex align-items-center" style="height:100vh; margin-left: 20vw;">
  <div class="main-container d-flex flex-column mt-4">
    <div class="d-flex mx-4 mt-2 align-items-center ms-auto badge rounded-pill text-bg-info">
      <img src="icons/waktu.png" style="width: 2vw ;"> <h6 class="px-4" id="waktu"></h6> 
    </div>
    <div class="d-flex mx-4 align-items-center mt-2">
      <img src="icons/co2.png" style="width: 4vw ;"> <h2 class="px-4" id="co2"></h2> 
    </div>
    <div class="d-flex mx-4 align-items-center mt-2">
      <img src="icons/humidity.png" style="width: 4vw ;"> <h2 class="px-4" id="humidity"></h2>
    </div>
    <div class="d-flex mx-4 align-items-center mt-2">
      <img src="icons/suhu.png" style="width: 4vw ;"> <h2 class="px-4" id="suhu"></h2>
    </div>
    <div class="d-flex mx-4 align-items-center mt-2">
      <img src="icons/light.png" style="width: 4vw ;"> <h2 class="px-4" id="lux"></h2>
    </div>
    <div class="d-flex mx-4 align-items-center mt-2">
      <img src="icons/mist-maker.png" style="width: 4vw ;"> <h2 class="px-4" id="mist-maker"></h2>
    </div>
    <div class="d-flex mx-4 align-items-center mt-2">
      <img src="icons/solenoid.png" style="width: 4vw ;"> <h2 class="px-4" id="solenoid"></h2>
    </div>
    <div class="d-flex mx-4 align-items-center mt-2">
      <img src="icons/lamp.png" style="width: 4vw ;"> <h2 class="px-4" id="lamp"></h2>
    </div>
  </div>
</div>

<script>
  setInterval(() => {
      // fetch(`https://skripsiarman.my.id/IOTEmersedMonitoring/api/get-realtime`, { // hosting
      fetch(`http://localhost/IOTemersedMonitoring/api/realtime`, {
          headers: {
            'Content-Type': 'application/json'
          }
      }).then((response) => {
        return response.json()
      })
      .then((data) => {
        console.log(data[0])
        document.getElementById("co2").innerHTML = 'CO 2 : ' + data[0].co2 + ' PPM'
        document.getElementById("humidity").innerHTML = 'Humidity : ' + data[0].humidity + ' %'
        // document.getElementById("suhu").innerHTML = 'Suhu : ' + data[0].suhu + ' °C'
        document.getElementById("lux").innerHTML = 'Intensitas Cahaya : ' + data[0].lux + ' lx'
        document.getElementById("waktu").innerHTML = data[0].waktu
        const waktu = new Date(data[0].waktu);
        const jam = waktu.getHours();
        let statusSolenoid = "none"
        if (parseInt(data[0].co2) <= 1000) {
          statusSolenoid = "ON"
        }else{
          statusSolenoid = "OFF"
        }
        if (parseInt(data[0].humidity) <= 80) {
          statusMistMaker = "ON"
        }else{
          statusMistMaker = "OFF"
        }
        if (parseInt(jam) <= 7+data[0].lama_hidup) {
          statusLampu = "ON"
        }else{
          statusLampu = "OFF"
        }
        document.getElementById("mist-maker").innerHTML = 'Mist maker = ' + statusMistMaker
        document.getElementById("solenoid").innerHTML = 'Solenoid = ' + statusSolenoid
        document.getElementById("lamp").innerHTML = 'lampu = ' + statusLampu
      });
  }, 500);
</script>
<?php include_once 'footer.php' ?>