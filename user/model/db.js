// model/db.js
const mysql = require('mysql');

const db = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "rentify",
    options: {
      trustedconnection: true,
      enableArithAort: true,
      instancename: 'SQLEXPRESS'
    }
});

// Connect to the database [rentify]
db.connect((error) => {
  if (error) {
      console.error('Error connecting to MySQL:', error.message);
  } else {
      console.log('Connected to ' + process.env.MYSQL_DATABASE);
  }
});

module.exports = db;