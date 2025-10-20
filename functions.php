<?php
    function sqlAllCustomers(){
        return("SELECT * FROM customers ORDER BY last_name, first_name");
    }
    function ssqlAvailableBikes(){
        return('SELECT bike_id, model, type, hourly_rate FROM bikes WHERE available = 1 ');
    }
    function sqlBikeRentals(){ //Needs to remove nulls
        return('SELECT bikes.model, customers.first_name, customers.last_name, rentals.start_time, rentals.end_time
                FROM rentals
                JOIN customers ON rentals.customer_id = customers.customer_id
                JOIN bikes ON rentals.bike_id = bikes.bike_id
                ');
    }
    function sqlMorningRentals(){
        return("SELECT * FROM rentals WHERE start_time < '12:00:00' ORDER BY start_time");
    }
    function sqlTop3Bikes(){
        return("SELECT * FROM bikes ORDER BY hourly_rate DESC LIMIT 3  ");
    }
