const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));

//Create connection to the database
const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "stories"
});

const showAdminListQuery = "SELECT username FROM authorizedusers";
const addAdminQuery = 'INSERT INTO authorizedusers (username, password) VALUES (?, ?)';

// Connect to database
con.connect(function(err) {
    if(err) throw err;
    console.log("Connected!")

    // 1. Display list from database
    con.query(showAdminListQuery, function (err, result){
       if (err) throw err;
       console.log("Admin List: ", result);
    });
});

// 2. Display form for entering more data into database
app.get('/form', (req, res) => {
    res.send(
        `<form action="/submit" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"> 
            <br>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <br>
            <br>
            <input type="submit" value="Add Admin">
        </form>`
    );
});

// 3. Add new data to the database and display new admin list
app.post('/submit', (req, res) => {
    const {username, password} = req.body;

        con.query(addAdminQuery, [username, password], function (err, result){
           if (err) throw err;
           console.log('Admin added successfully!');

        // Display updated admin list
        con.query(showAdminListQuery, function (err, result, fields){
            if (err) throw err;
            console.log(result);
        });
    });
});

// con.query("DELETE FROM authorizedusers WHERE username = 'newAdmin2'");

// Start the server
app.listen(3000, () => {
  console.log('Server is running on port 3000');
});