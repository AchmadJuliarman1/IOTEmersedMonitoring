<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="container text-center"><h1>Downoi Emersed IOT Monitoring</h1></div>
        <div class="container bg-dark mt-3">
          <div class="d-flex text-center">
            <div class="container p-2">
              <h5 class="text-light">Moisture</h5>
              <div class="card m-3 bg-dark">
                <h4 class="card-body fw-bold text-warning" id="mois">---</h4>
                <h4 class="card-body fw-bold text-warning">DC Pump Status <h4 id="status" class="text-primary"></h4></h4>
              </div>
            </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      setInterval(() => {
        fetch(`http://localhost/IOTemersedMonitoring/api/realtime`)
          .then((response) => {
            return response.json()
          })
          .then((data) => {
            console.log(data)
            document.getElementById("mois").innerHTML = data[0]["moisture"]
            let status = "none"
            if (parseInt(data[0]["moisture"]) >= 350) {
              status = "ON"
            }else{
              status = "OFF"
            }
            console.log(status);
            document.getElementById("status").innerHTML = status
          });
      }, 500);
    </script>
  </body>
</html>