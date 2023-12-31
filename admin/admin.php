<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="flight.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>ALMA</h2>
            <a href="dashboard.html">Dashboard</a>
            <a href="admin.php">Admin</a>
            <a href="booking.html">Bookings</a>
            <a href="flights.html">Flights</a>
            <a href="hotels.html">Hotels</a>
        </div>

        <div class="content">
            <header>
                <h1>Welcome to the Admin Dashboard</h1>
            </header>
            <main class="main">
                <form action="dbcon.php" method="post">
                    <fieldset>
                    <legend>flights manager</legend>
                  
                    <label for="departure_date">Departure Date :</label>
                    <input type="date" id="departure_date" name="departure_date" required><br>
                    
                    
                      
                        
                                 
                    <label for="return-date">return Date:</label>
                    <input type="date" id="return-date" name="return-date" required><br>

                    <label for="nombre_de_personne">nombre de personne</label>
                    <input type="number" name="nbr_personne" id="" min="1">


                                    
                    
                </fieldset>
                  </form>

                  <form action="admin.php" method="POST">
                    <label for="destination">Destination :</label>
                    <select name="destination" id="">
                        
                        <option value="">
                        </option>
                        
                    </select>
                    <div class="btn"><button name="btn" type="submit">Add Flight</button></div>
                  
                </form>

                <form action="dbcon.php" method="post">
                    <fieldset>
                    <legend>hotels manager</legend>
                  
                    <label for="date_reserv">Date de reservation :</label>
                    <input type="date" id="date_reserv" name="date_reserv" required><br>
                    
                     
                    <label for="reserve_fin">fin de reservation</label>
                    <input type="date" id="reserve_fin" name="reserve_fin" required><br>

                    <label for="nombre_de_personne">nombre de personne</label>
                    <input type="number" name="nbr_personne" id="" min="1">

                    <div class="btn"><button type="submit">Add </button></div>

                </fieldset>
                  </form>
                  
            </main>
        </div>
    </div>

    <script src="admin.js">
      
    </script>
</body>
</html>
